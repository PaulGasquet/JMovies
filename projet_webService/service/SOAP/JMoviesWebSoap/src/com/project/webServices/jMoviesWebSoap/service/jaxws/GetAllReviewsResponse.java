
package com.project.webServices.jMoviesWebSoap.service.jaxws;

import javax.xml.bind.annotation.XmlAccessType;
import javax.xml.bind.annotation.XmlAccessorType;
import javax.xml.bind.annotation.XmlElement;
import javax.xml.bind.annotation.XmlRootElement;
import javax.xml.bind.annotation.XmlType;

/**
 * This class was generated by Apache CXF 2.7.18
 * Mon Apr 12 22:07:16 CEST 2021
 * Generated source version: 2.7.18
 */

@XmlRootElement(name = "getAllReviewsResponse", namespace = "http://service.jMoviesWebSoap.webServices.project.com/")
@XmlAccessorType(XmlAccessType.FIELD)
@XmlType(name = "getAllReviewsResponse", namespace = "http://service.jMoviesWebSoap.webServices.project.com/")

public class GetAllReviewsResponse {

    @XmlElement(name = "return")
    private java.util.ArrayList<com.project.webServices.jMoviesWebSoap.model.Review> _return;

    public java.util.ArrayList<com.project.webServices.jMoviesWebSoap.model.Review> getReturn() {
        return this._return;
    }

    public void setReturn(java.util.ArrayList<com.project.webServices.jMoviesWebSoap.model.Review> new_return)  {
        this._return = new_return;
    }

}

