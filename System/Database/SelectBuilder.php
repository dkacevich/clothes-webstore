<?php

namespace System\Database;

use Exception;

class SelectBuilder {
    protected string $table;
    protected array $cols = ['*'];
    protected array $conditions = [
        'join' => null,
		'where' => null,
		'group_by' => null,
		'having' => null,
		'order_by' => null,
		'limit' => null
    ];

    public function __construct(string $table) {
        $this->table = $table;
        return $this;
    }

    public function getCols(array $cols) {
        $this->cols = $cols;
        return $this;
    }

    public function __ToString() : string {
        $activeCommands = [];


        foreach ($this->conditions as $command => $setting) {
            if ($setting !== null ) {
                $sqlKey = str_replace('_', ' ', strtoupper($command));
                $activeCommands[] = "$sqlKey $setting";
            }
        }

        
        $strCommands = implode(' ', $activeCommands);
        $cols =implode(', ', $this->cols);

        return  trim("SELECT {$cols} FROM {$this->table} {$strCommands}");
    }

    public function __call(string $name, array $args) {

        if (!array_key_exists($name, $this->conditions)) {
            throw new Exception('sql syntax error');
        }

        $this->conditions[$name] = $args[0];
        return $this;
    }



}