<?php

namespace Modules\Add\Models;

use Aws\S3\S3Client;
use Modules\_base\Model as BaseModel;
use Rakit\Validation\Validator;
use System\ArrayHelper;
use System\Database\Connection;
use System\Exceptions\ExcValidate;

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

    public function __construct(Connection $db) {
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


        $names = implode(', ', $namesArr);
        $masks = implode(', ', $masksArr);

        $query = "INSERT INTO {$this->table} ($names) VALUES ($masks)";


        $params = ArrayHelper::extractFields($fields, ['name', 'price', 'image', 'id_category']);
        $this->db->query($query, $params);

        

        // Save tags to separate DB
        if (!empty($fields['tag'])) {
            $productId = $this->db->lastInsertId();
            foreach ($fields['tag'] as $tag) {
                $query = "INSERT INTO tags_products (id_tag, id_product) VALUES (:id_tag, :id_product)";
                $this->db->query($query, ['id_tag' => $tag, 'id_product' => $productId]);
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
