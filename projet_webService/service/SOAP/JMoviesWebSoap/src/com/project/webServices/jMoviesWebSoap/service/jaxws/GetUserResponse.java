
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

@XmlRootElement(name = "getUserResponse", namespace = "http://service.jMoviesWebSoap.webServices.project.com/")
@XmlAccessorType(XmlAccessType.FIELD)
@XmlType(name = "getUserResponse", namespace = "http://service.jMoviesWebSoap.webServices.project.com/")

public class GetUserResponse {

    @XmlElement(name = "return")
    private java.util.ArrayList<com.project.webServices.jMoviesWebSoap.model.User> _return;

    public java.util.ArrayList<com.project.webServices.jMoviesWebSoap.model.User> getReturn() {
        return this._return;
    }

    public void setReturn(java.util.ArrayList<com.project.webServices.jMoviesWebSoap.model.User> new_return)  {
        this._return = new_return;
    }

}

