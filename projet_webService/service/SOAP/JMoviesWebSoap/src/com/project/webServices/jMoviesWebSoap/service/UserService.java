package com.project.webServices.jMoviesWebSoap.service;

import java.util.ArrayList;

import javax.jws.WebMethod;
import javax.jws.WebParam;
import javax.jws.WebResult;
import javax.jws.WebService;

import com.project.webServices.jMoviesWebSoap.model.Review;
import com.project.webServices.jMoviesWebSoap.model.User;
/**
 * This class is the interface with the annotations and the prototype of each method use for get and add data
 *
 */
@SuppressWarnings("restriction")
@WebService(name = "UserService", targetNamespace = "http://service.jMoviesWebSoap.webServices.project.com/")
public interface UserService {
	/**
	 * 
	 * @param id of the user
	 * @return a list with all the reviews of the user
	 */
	@WebMethod(operationName = "getAllReviews", action = "urn:GetAllReviews")
	@WebResult(name = "return")
	public ArrayList <Review> getAllReviews(@WebParam(name = "arg0") int id);
	
	/**
	 * 
	 * @param id of the user
	 * @return a list with all the best reviews of the user
	 */
	@WebMethod(operationName = "getBestReviews", action = "urn:GetBestReviews")
	@WebResult(name = "return")
	public ArrayList <Review> getBestReviews(@WebParam(name = "arg0") int id);
	
	/**
	 * 
	 * @param id of the user
	 * @return a list with all the worst reviews of the user
	 */
	@WebMethod(operationName = "getWorstReviews", action = "urn:GetWorstReviews")
	@WebResult(name = "return")
	public ArrayList <Review> getWorstReviews(@WebParam(name = "arg0") int id);
	
	/**
	 * 
	 * @param user who are going to be create
	 */
	@WebMethod(operationName = "CreateUser", action = "urn:CreateUser")
	@WebResult(name = "return")
	public void CreateUser (@WebParam(name = "arg0") User user);
	
	/**
	 * 
	 * @param id of the user
	 * @return one user given a user_id
	 */
	@WebMethod(operationName = "getUser", action = "urn:GetUser")
	@WebResult(name = "return")
	public ArrayList<User> getUser(@WebParam(name = "arg0") int user_id);
	
	/**
	 * 
	 * @return a list of all user
	 */
	@WebMethod(operationName = "getAllUser", action = "urn:GetAllUser")
	@WebResult(name = "return")
	public ArrayList <User> getAllUser();
	
	 /**
	  * 
	  * @param review who are going to be add
	  */
	@WebMethod(operationName = "addReviews", action = "urn:AddReviews")
	@WebResult(name = "return")
	public void addReviews(@WebParam(name = "arg0") Review review);
}
