<?php
namespace app\helpers;

class Email {
	protected $_to;
	protected $_from = "noreply@42camagru.zzz.com.ua";
	protected $_reply;
	protected $_content;
	protected $_subject;
	protected $_body;

	 public function sendEmail() {
	 	mail($this->_to, $this->_subject, $this->_body, $this->buildHeaders());
	}

	protected function buildHeaders() {
		$headers[] = 'From: ' . $this->_from;
		if (isset($this->_reply))
			$headers[] = 'Reply-To: ' . $this->_replay;
		if ($this->_content === 'html')
			$headers[] = 'Content-type: text/html; charset=iso-8859-1';
		return implode("\r\n", $headers);
	}

	public function setTo($to) {
		$this->_to = $to;
		return $this;
	}

	public function setFrom($from) {
		$this->_from = $from;
		return $this;
	}

	public function setSubject($subject) {
		$this->_subject = $subject;
		return $this;
	}

	public function setBody($body) {
		$this->_body = $body;
		return $this;
	}

	public function setReply($reply) {
		$this->_reply = $reply;
		return $this;
	}

	public function setContent($content) {
		$this->_content = $content;
		return $this;
	}
}