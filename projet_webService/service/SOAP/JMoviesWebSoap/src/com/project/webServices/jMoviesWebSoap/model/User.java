package com.project.webServices.jMoviesWebSoap.model;

import javax.xml.bind.annotation.XmlRootElement;
/**
 * This class is the model for a user
 *
 */
@XmlRootElement
public class User {
	private int userId;
	private String userName;
	private String preference;
	public User() {
		
	}
	public User(int user_id, String userName, String preference) {
		this.userId = user_id;
		this.userName = userName;
		this.preference = preference;
	}
	public int getUser_id() {
		return userId;
	}
	public void setUser_id(int user_id) {
		this.userId = user_id;
	}
	public String getUserName() {
		return userName;
	}
	public void setUserName(String userName) {
		this.userName = userName;
	}
	public String getPreference() {
		return preference;
	}
	public void setPreference(String preference) {
		this.preference = preference;
	}
	
}