package com.unialfa.hackathonsite.model;

import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.Id;

@Entity
public class Marca {
	@Id
	@GeneratedValue(strategy = GenerationType.AUTO)
	private Long id;
	private String marca;

	public Long getId() {
		return id;
	}

	public String getMarca() {
		return marca;
	}

}
