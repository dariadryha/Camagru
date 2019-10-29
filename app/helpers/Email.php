<?php
namespace app\helpers;

class Email
{
    const HTML = 'html';

    /** @var string $to */
	private $to;

    /** @var string $from */
	private $from = "noreply@42camagru.zzz.com.ua";

    /** @var array $reply */
	private $reply = [];

    /** @var string $content */
	private $content;

    /** @var string $subject */
	private $subject;

    /** @var string $body */
	private $body;

    /**
     * @return bool
     */
	public function sendEmail(): bool
    {
         return mail($this->to, $this->subject, $this->body, $this->buildHeaders());
	}

    /**
     * @return string
     */
	private function buildHeaders(): string
    {
        $headers[] = 'From: ' . $this->from;

		if (empty($this->reply) === false)
			$headers[] = 'Reply-To: ' . implode(',', $this->reply);
		//TODO content type
		$headers[] = 'Content-type: text/html; charset=iso-8859-1';

        return implode("\r\n", $headers);
	}

    /**
     * @param string $to
     * @return Email
     */
	public function setTo(string $to): Email
    {
		$this->to = $to;

		return $this;
	}

    /**
     * @param string $from
     * @return Email
     */
	public function setFrom(string $from): Email
    {
		$this->from = $from;

		return $this;
	}

    /**
     * @param string $subject
     * @return Email
     */
	public function setSubject(string $subject): Email
    {
		$this->subject = $subject;

		return $this;
	}

    /**
     * @param string $body
     * @return Email
     */
	public function setBody(string $body): Email
    {
		$this->body = $body;

		return $this;
	}

    /**
     * @param mixed $reply
     * @return Email
     */
	public function setReply($reply): Email
    {
		if (is_array($reply))
		    $this->reply = array_merge($this->reply, $reply);
		else
		    $this->reply[] = $reply;

		return $this;
	}

    /**
     * @param string $content
     * @return Email
     */
	public function setContent(string $content): Email
    {
		$this->content = $content;

		return $this;
	}
}