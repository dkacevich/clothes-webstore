<?php

namespace Modules\Add\Models;

use Aws\S3\Exception\S3Exception;
use Aws\S3\S3Client;
use Rakit\Validation\Validator;
use System\Exceptions\ExcValidate;

class Index {
    protected Validator $validator;
    protected array $validateRules = [
        'product-name' => 'required|min:2',
        'product-price' => 'required|numeric',
        'product-photo' => 'uploaded_file|max:5M|mimes:jpeg,png',
    ];

    protected string $bucket = 'phpclothes';
    protected string $region = 'eu-central-1';

    protected array $config;

    public function __construct() {
        // TODO Dependency injection
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
        if ($fields['product-photo']['error'] === 0) {
            // var_dump($fields['product-photo']);
            $this->uploadImage($fields['product-photo']);
        }
    }

    protected function uploadImage(mixed $img) {
        $s3 = new S3Client($this->config);

        $ext = preg_replace('/^.+\./', '', $img['name']);
        $key = bin2hex(random_bytes(30)) . ".$ext";

        // TODO Url for DataBase;
        $url = "https://{$this->bucket}.{$this->region}.amazonaws.com/$key";

        $s3->putObject([
            'Bucket' => $this->bucket,
            'Key'    => $key,
            'Body'   => fopen($img["tmp_name"], 'r'),
            'ACL'    => 'public-read',
        ]);

        return $url;
    }
}
