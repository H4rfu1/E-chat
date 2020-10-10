<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email extends CI_Controller {
	public function index(){
		echo "go to send update";
	}
	public function send($email,$domain, $subjek, $message){
		$email .= '@'.$domain;
		// var_dump($email) ;
		$config = [
			'protocol'  => 'smtp',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_user' => 'takun917@gmail.com',
			'smtp_pass' => 'pelatok917',
			'smtp_port' => 465,
			'mailtype'  => 'html',
			'charset' => 'utf-8',
			'newline' => "\r\n",
		];
		$this->load->library('email', $config);
		$this->email->from('takun917@gmail.com', 'simpeltinkap');
		$this->email->to($email);
		$this->email->subject($subjek);
		$this->email->message($message);

		if($this->email->send()){
			echo "berhasil dikirim";
			return true;
		}else{
			echo $this->email->print_debugger(); die;
		}
	}
}
