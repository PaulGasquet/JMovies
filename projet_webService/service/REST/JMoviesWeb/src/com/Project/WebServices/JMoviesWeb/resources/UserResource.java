package com.Project.WebServices.JMoviesWeb.resources;

import java.util.ArrayList;

import javax.ws.rs.Consumes;
import javax.ws.rs.GET;
import javax.ws.rs.POST;
import javax.ws.rs.Path;
import javax.ws.rs.PathParam;
import javax.ws.rs.Produces;
import javax.ws.rs.core.MediaType;

import com.Project.WebServices.JMoviesWeb.model.Review;
import com.Project.WebServices.JMoviesWeb.model.User;
import com.Project.WebServices.JMoviesWeb.service.UserService;

@Path("userResource")
public class UserResource {
	UserService userService = new UserService();
	
	/**
	 * 
	 * @param user_id is the id of the user
	 * @return a list of all reviews given by the user id
	 */
    @GET
    @Path("/{user_id}")
    @Produces(MediaType.APPLICATION_XML)
    public ArrayList <Review> getAllReviews(@PathParam("user_id") int user_id) {
    	System.out.println("Avec REST, on essaie de consulter toutes les reviews de l'utilisateur ayant l'id "+user_id+"\n");
        return userService.getAllReviews(user_id);
    }   
	/**
	 * 
	 * @param user_id is the id of the user
	 * @return a list of the best reviews given by the user id
	 */
    @GET
    @Path("/{user_id}/best")
    @Produces(MediaType.APPLICATION_XML)
    public ArrayList <Review> getBestReviews(@PathParam("user_id") int user_id) {
    	System.out.println("Avec Rest , on consulte les meilleures reviews de l'utilisateur ayant l'id "+user_id+"\n");
        return userService.getBestReviews(user_id);
    }   
	/**
	 * 
	 * @param user_id is the id of the user
	 * @return a list of the worst reviews given by the user id
	 */
    @GET
    @Path("/{user_id}/worst")
    @Produces(MediaType.APPLICATION_XML)
    public ArrayList <Review> getWorstReviews(@PathParam("user_id") int user_id) {
    	System.out.println("Avec Rest , on consulte les pires reviews de l'utilisateur ayant l'id "+user_id+"\n");
        return userService.getWorstReviews(user_id);
    }    
    /**
     * 
     * @param user who are going to be create
     */
    @POST
    @Path("/Create")
    @Consumes(MediaType.APPLICATION_XML)
    @Produces(MediaType.APPLICATION_XML)
    public User CreateUser (User user) {
    	userService.CreateUser(user);
    	return user;
    }
    
    /**
     * 
     * @param review who are going to be add
     */
    @POST
    @Path("/addReview")
    @Consumes(MediaType.APPLICATION_XML)
    @Produces(MediaType.APPLICATION_XML)
    public Review addReviews (Review review) {
    	userService.addReviews(review);
    	return review;
    }
	/**
	 * 
	 * @return a list of all user
	 */
    @GET
    @Path("/users")
    @Produces(MediaType.APPLICATION_XML)
    public ArrayList <User> getAllUser() {
    	System.out.println("Avec REST, on consulte les utilisateurs");
        return userService.getAllUser();
    }
    @GET
    @Path("/{user_id}/oneUser")
    @Produces(MediaType.APPLICATION_XML)
    public ArrayList<User> getUser(@PathParam("user_id") int user_id) {
    	System.out.println("Avec REST, on consulte l'utilisateur ayant l'id "+user_id+"\n");
        return userService.getUser(user_id);
    }
}

