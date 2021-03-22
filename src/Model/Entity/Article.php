<?php

//test
// src/Model/Entity/Article.php
namespace App\Model\Entity;
use Cake\Collection\Collection;
use Cake\ORM\Entity;
class Article extends Entity
{

	public function testNew()
	{
		return "test data";
	}

	protected $_accessible = [
		'*' => true,
		'id' => false,
		'slug' => false,
		'tag_string' => true
		];

	public function _getTagString()
	{
		if (isset($this->_fields['tag_string'])) {
		return $this->_fields['tag_string'];
	}
		if (empty($this->tags)) {
		return 'no tags';
	}
		$tags = new Collection($this->tags);
		$str = $tags->reduce(function ($string, $tag) {
		return $string . $tag->title . ', ';
	}, '');
		return trim($str, ', ');
	}

	protected function test(){
		return "test";
	}

}