<?php

namespace Modules\Add\Models;

use Aws\S3\S3Client;
use Modules\_base\Model as BaseModel;
use Rakit\Validation\Validator;
use System\ArrayHelper;
use System\DB;
use System\Exceptions\ExcValidate;
use RedBeanPHP\R;

class Index extends BaseModel {
    protected Validator $validator;
    protected array $validateRules = [
        'name' => 'required|min:2',
        'price' => 'required|numeric',
        'image' => 'uploaded_file|max:5M|mimes:jpeg,png',
    ];

    protected string $bucket = 'phpclothes';
    protected string $region = 'eu-central-1';

    protected array $config;
    protected string $table = 'products';

    public function __construct(DB $db) {
        parent::__construct($db);
        $this->validator = new Validator();
        $this->config = [
            'region' => $this->region,
            'version' => 'latest',
            'credentials' => [
                'key'    => 'AKIARV62BHHQ4CNZMZSN',
                'secret' => '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'
            ],
        ];
    }

    public function add(array $fields) {
        $validation = $this->validator->validate($fields, $this->validateRules);

        if ($validation->fails()) {
            throw new ExcValidate('Validation fails in Add module', $validation->errors());
        }

        // Check if photo was sent
        if ($fields['image']['error'] === 0) {
            $fields['image'] = $this->uploadImage($fields['image']);
        } else {
            $fields['image'] = null;
        }

        // Check if category was choosen
        if (!isset($fields['id_category'])) {
            $fields['id_category'] = null;
        }


        $namesArr = [];
        $masksArr = [];

        foreach ($fields as $name => $value) {
            if ($name !== 'tag') {
                $namesArr[] = $name;
                $masksArr[] = ":$name";
            }
        }



        $params = ArrayHelper::extractFields($fields, ['name', 'price', 'image', 'id_category']);

        $product = R::dispense($this->table);
        foreach ($params as $key => $value) {
            $product->$key = $value;
        }
        $productId = R::store($product);

        
        // Save tags to separate DB
        if (!empty($fields['tag'])) {
            foreach ($fields['tag'] as $tag) {
                $tagBean = R::xdispense('tags_products');
                $tagBean->id_tag = $tag;
                $tagBean->id_product = $productId;
                
                R::store($tagBean);
            }
        }
    }

    

    protected function uploadImage(mixed $img): string {
        $s3 = new S3Client($this->config);

        // Make random img name
        $ext = preg_replace('/^.+\./', '', $img['name']);
        $key = bin2hex(random_bytes(30)) . ".$ext";


        $res = $s3->putObject([
            'Bucket' => $this->bucket,
            'Key'    => $key,
            'Body'   => fopen($img["tmp_name"], 'r'),
            'ACL'    => 'public-read',
        ]);

        // If error will happen, S3Client throw new Error

        return $res['ObjectURL'];
    }
}
