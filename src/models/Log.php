<?php

class Log
{
    private string $datetime;
    private string $level;
    private string $context;
    private string $description;

    public function __construct(string $level, string $context, string $description)
    {
        $this->datetime = date('Y-m-d H:i:s');
        $this->level = strtoupper($level);
        $this->context = strtoupper($context);
        $this->description = $description;
    }

    public function get_attributes(): array
    {
        return [
            'datetime' => $datetime,
            'level' => $level,
            'context' => $context,
            'description' => $description,
        ];
    }
}
