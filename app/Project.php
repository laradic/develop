<?php
namespace App;

class Project
{
    public $version = '';

    public $component = [];
}

class Component
{
    public $name = '';

    public $mapping = [];
}

class Mapping
{
    public $directory;

    public $vcs;
}