package com.Project.WebServices.JMoviesWeb.model;

import javax.xml.bind.annotation.XmlRootElement;

/**
 * This class is the model for a review
 *
 */
@XmlRootElement
public class Review {
	private int reviewId;
	private String reviewContent;
	private String mark;
	private int user_id;
	private String movieTitle;
	public Review() {
		
	}
	public Review(int reviewId, String reviewContent, String mark, int user_id, String movieTitle) {
		this.reviewId = reviewId;
		this.reviewContent = reviewContent;
		this.mark = mark;
		this.user_id = user_id;
		this.movieTitle = movieTitle;
	}
	public int getReviewId() {
		return reviewId;
	}
	public void setReviewId(int reviewId) {
		this.reviewId = reviewId;
	}
	public String getReviewContent() {
		return reviewContent;
	}
	public void setReviewContent(String reviewContent) {
		this.reviewContent = reviewContent;
	}
	public String getMark() {
		return mark;
	}
	public void setMark(String mark) {
		this.mark = mark;
	}
	public int getUser_id() {
		return user_id;
	}
	public void setUser_id(int user_id) {
		this.user_id = user_id;
	}
	public String getMovieTitle() {
		return movieTitle;
	}
	public void setMovieTitle(String movieTitle) {
		this.movieTitle = movieTitle;
	}
}