<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Google {
	
	public function __construct($config) {
		
		require APPPATH .'third_party/google-login-api/ApiClient.php';
		require APPPATH .'third_party/google-login-api/contrib/apiOauth2Service.php';
		
		$this->client = new apiClient();
		$this->client->setApplicationName($config['application_name']);
		$this->client->setClientId($config['client_id']);
		$this->client->setClientSecret($config['client_secret']);
		$this->client->setRedirectUri($config['redirect_uri']);
		$this->client->setDeveloperKey($config['api_key']);
		$this->client->setScopes($config['scopes']);
		$this->client->setAccessType('online');
		$this->client->setApprovalPrompt('auto');
		$this->oauth2 = new apiOauth2Service($this->client);

	}
	
	public function loginURL() {
		return $this->client->createAuthUrl();
	}
	
	public function getAuthenticate() {
		return $this->client->authenticate();
	}
	
	public function getAccessToken() {
		return $this->client->getAccessToken();
	}
	
	public function setAccessToken() {
		return $this->client->setAccessToken();
	}
	
	public function revokeToken() {
		return $this->client->revokeToken();
	}
	
	public function getUserInfo() {
		return $this->oauth2->userinfo->get();
	}
	
	
}
?>