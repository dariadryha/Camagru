<?php

class ErrorHandlers {
	public static function handleNotEmpty($label) {
		return "$label is a required field.";
	}
}