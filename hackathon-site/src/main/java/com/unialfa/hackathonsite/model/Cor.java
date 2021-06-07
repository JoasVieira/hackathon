package com.unialfa.hackathonsite.model;

import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.Id;

@Entity
public class Cor {
	@Id
	@GeneratedValue(strategy = GenerationType.AUTO)
	private Long id;
	private String cor;

	public Long getId() {
		return id;
	}

	public String getCor() {
		return cor;
	}

}
