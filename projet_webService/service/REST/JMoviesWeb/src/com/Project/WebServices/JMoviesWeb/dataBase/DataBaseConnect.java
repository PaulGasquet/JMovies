package com.Project.WebServices.JMoviesWeb.dataBase;

import java.sql.Connection;
import java.sql.DriverManager;


/**
 * Point of connection with the data source which using the postgreSql RDBMS.
 * 
 * @author Paul
 * @version 1.0
 *
 */
public class DataBaseConnect {
	private static String user = "root";
	private static String password = "";
	private static String url = "jdbc:mysql://localhost/db_jmovies?zeroDateTimeBehavior=CONVERT_TO_NULL&serverTimezone=UTC";
	

	/**
	 * Established the connection with the postgreSql database if this is not already done. 
	 * 
	 * @return an instance of Connection, which is the point of connection with the postgreSql database.
	 */
	private static Connection connection;

	public static Connection getConnection() {
		if (connection == null) {
			try {
				Class.forName("com.mysql.cj.jdbc.Driver");
				connection = DriverManager.getConnection(url, user, password);
			} catch (Exception e) {
				System.err.println("Connection failed : " + e.getMessage());			
			}
		}
		return connection;
	}
}