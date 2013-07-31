<?php
namespace RqData\Html;

interface SingleOption {
	public function getHumanName();
	public function getCode();
	public function getValue();
}