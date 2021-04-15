package com.project.webServices.jMoviesWebSoap.service;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.Random;

import javax.jws.WebService;

import com.project.webServices.jMoviesWebSoap.model.Review;
import com.project.webServices.jMoviesWebSoap.model.User;

import com.project.webServices.jMoviesWebSoap.dataBase.*;
/**
 * This class implement all the function use for get and add data
 *
 */
@WebService(targetNamespace = "http://service.jMoviesWebSoap.webServices.project.com/", endpointInterface = "com.project.webServices.jMoviesWebSoap.service.UserService", portName = "UserServiceImplPort", serviceName = "UserServiceImplService")
public class UserServiceImpl implements UserService{
	
	public ArrayList <Review> getAllReviews(int id){
		Connection dbConnection = DataBaseConnect.getConnection();
		ArrayList <Review> ListReview = new ArrayList<Review>();
		int review_id;
		String mark;
		String reviewcontent;
		int user_id;
		String movieTitle;
		String request = "SELECT * FROM review where user_id = ?";
		try {
			PreparedStatement preparedStatement = dbConnection.prepareStatement(request);
			preparedStatement.setInt(1,id);
			ResultSet result = preparedStatement.executeQuery();
			while (result.next()) {
				review_id = result.getInt("review_id");
				mark = result.getString("mark");
				reviewcontent = result.getString("reviewcontent");
				user_id = result.getInt("user_id");
				movieTitle = result.getString("movie_title");
				Review review = new Review(review_id,reviewcontent,mark,user_id,movieTitle);
				ListReview.add(review);
			}
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		System.out.print("Avec SOAP, on consulte les reviews de l'utilisateur ayant l'id "+id);
		return ListReview;
	}
	

	public ArrayList <Review> getBestReviews(int id){
		Connection dbConnection = DataBaseConnect.getConnection();
		ArrayList <Review> ListReview = new ArrayList<Review>();
		int review_id;
		String mark;
		String reviewcontent;
		int user_id;
		String movieTitle;
		String request = "SELECT * FROM review where user_id = ? AND mark >= 4";
		try {
			PreparedStatement preparedStatement = dbConnection.prepareStatement(request);
			preparedStatement.setInt(1,id);
			ResultSet result = preparedStatement.executeQuery();
			while (result.next()) {
				review_id = result.getInt("review_id");
				mark = result.getString("mark");
				reviewcontent = result.getString("reviewcontent");
				user_id = result.getInt("user_id");
				movieTitle = result.getString("movie_title");
				Review review = new Review(review_id,mark,reviewcontent,user_id,movieTitle);
				ListReview.add(review);
			}
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		System.out.print("Avec SOAP, on consulte les meilleurs reviews de l'utilisateur ayant l'id "+id);
		return ListReview;
	}
	
	public ArrayList <Review> getWorstReviews(int id){
		Connection dbConnection = DataBaseConnect.getConnection();
		ArrayList <Review> ListReview = new ArrayList<Review>();
		int review_id;
		String mark;
		String reviewcontent;
		int user_id;
		String movieTitle;
		String request = "SELECT * FROM review where user_id = ? AND mark <= 2";
		try {
			PreparedStatement preparedStatement = dbConnection.prepareStatement(request);
			preparedStatement.setInt(1,id);
			ResultSet result = preparedStatement.executeQuery();
			while (result.next()) {
				review_id = result.getInt("review_id");
				mark = result.getString("mark");
				reviewcontent = result.getString("reviewcontent");
				user_id = result.getInt("user_id");
				movieTitle = result.getString("movie_title");
				Review review = new Review(review_id,mark,reviewcontent,user_id,movieTitle);
				ListReview.add(review);
			}
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		System.out.print("Avec SOAP, on consulte les pires reviews de l'utilisateur ayant l'id "+id);
		return ListReview;
	}

	public void CreateUser (User user) {
		try {
			Connection dbConnection = DataBaseConnect.getConnection();
			String request = "INSERT INTO user_web (user_id,username,preference)VALUES (?,?,?)";
			PreparedStatement preparedStatement = dbConnection.prepareStatement(request);
	
			//Set values of parameters in the query.
			preparedStatement.setInt(1, user.getUser_id());
			preparedStatement.setString(2, user.getUserName());
			preparedStatement.setString(3, user.getPreference());
			
			preparedStatement.executeUpdate();
	
			preparedStatement.close();
			System.out.print("Avec SOAP, User ayant l'id = "+user.getUser_id()+" ayant pour User name "+user.getUserName()+" et aimant les films "+user.getPreference()+" à été ajouté.\n");
		} catch (SQLException se) {
				System.err.println(se.getMessage());
		}
		
	}

	public ArrayList<User> getUser(int user_id) {
		Connection dbConnection = DataBaseConnect.getConnection();
		String request = "SELECT * FROM user_web WHERE user_id = "+ user_id;
		String username;
		String preference;
		ArrayList <User> ListUser = new ArrayList<User>();
		try {
			PreparedStatement preparedStatement = dbConnection.prepareStatement(request);
			ResultSet result = preparedStatement.executeQuery();
			if(result.next()) {
				user_id=result.getInt("user_id");
				username=result.getString("username");
				preference=result.getString("preference");
				User user = new User(user_id,username,preference);
				ListUser.add(user);
			}
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		System.out.print("Avec SOAP, on essaie de récupérer l'utilisteur ayant l'id "+user_id);
		return ListUser;
	}
	
	public ArrayList <User> getAllUser() {
		Connection dbConnection = DataBaseConnect.getConnection();
		String request = "SELECT * FROM user_web";
		int user_id;
		String username;
		String preference;
		ArrayList <User> ListUser = new ArrayList <User>();
		try {
			PreparedStatement preparedStatement = dbConnection.prepareStatement(request);
			ResultSet result = preparedStatement.executeQuery();
			while (result.next()) {
				user_id=result.getInt("user_id");
				username=result.getString("username");
				preference=result.getString("preference");
				User user = new User(user_id,username,preference);
				ListUser.add(user);
			}
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		System.out.print("Avec SOAP, on consulte les utilisateurs");
		return ListUser;
	}

	public void addReviews(Review review) {
		try {
			Connection dbConnection = DataBaseConnect.getConnection();
			Random rnd = new Random();
			int NewId = 10000 + rnd.nextInt(90000);
			String idQuery = "SELECT review_id FROM review";
			
			PreparedStatement numberOfUser = dbConnection.prepareStatement(idQuery);
			ResultSet result =  numberOfUser.executeQuery();
			while(result.next()){
				if(result.getInt(1) == NewId) {
					NewId = 10000 + rnd.nextInt(90000);
				}
			}

			String request = "INSERT INTO review (review_id,mark,reviewcontent,user_id,movie_title)VALUES (?,?,?,?,?)";
			PreparedStatement preparedStatement = dbConnection.prepareStatement(request);
	
			//Set values of parameters in the request.
			preparedStatement.setInt(1, NewId);
			preparedStatement.setString(2, review.getMark());
			preparedStatement.setString(3, review.getReviewContent());
			preparedStatement.setInt(4, review.getUser_id());
			preparedStatement.setString(5, review.getMovieTitle());
	
			preparedStatement.executeUpdate();
	
			preparedStatement.close();
			System.out.print("Avec SOAP, La review ayant l'id = "+NewId+" ayant comme titre de film "
			+review.getMovieTitle()+" ,ayant comme contenu "
			+review.getReviewContent()+" ayant comme note "
			+review.getMark()+" et ayant été posté par l'utilisateur avec l'id "+review.getUser_id()+" à été ajoutée.");
		} catch (SQLException se) {
				System.err.println(se.getMessage());
		}
		
	}
}