<?php
include_once('Admin.php');
include_once('User.php');

class Message {
	private $fromAdmin;
	private $toUser;
	private $subject;
	private $message;
	private $is_read;

	function __construct(Admin $fromAdmin, User $toUser) {
		$this->fromAdmin = $fromAdmin;
		$this->toUser = $toUser;
		$this->is_read = 0;
	}

	public function setSubject($subject) {
		$this->subject = $subject;
	}

	public function getSubject() {
		return $this->subject;
	}

	public function setMessage($message) {
		$this->message = $message;
	}

	public function getMessage() {
		return $this->message;
	}

	public function isRead() {
		return $this->is_read;
	}

	public function markRead() {
		$this->is_read = 1;
	}

	public function send() {}

	public static function getMessagesToUser(User $user){}
	public static function getMessagesFromAdmin(Admin $admin){}
	public static function checkIfUserHasUnreadMessages(User $user){}
}
?>