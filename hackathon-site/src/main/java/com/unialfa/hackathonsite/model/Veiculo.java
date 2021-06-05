package com.unialfa.hackathonsite.model;

import java.sql.Date;

import javax.persistence.Entity;
import javax.persistence.EnumType;
import javax.persistence.Enumerated;
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.Id;
import javax.persistence.ManyToOne;

import com.unialfa.hackathonsite.modules.Tipo;

@Entity
public class Veiculo {
	@Id
	@GeneratedValue(strategy = GenerationType.IDENTITY)
	private Long id;
	private String modelo;
	private Date anomodelo;
	private Date anofabricacao;
	private Double valor;

	@Enumerated(EnumType.STRING)
	private Tipo tipo;

	@ManyToOne
	private Marca marca;

	@ManyToOne
	private Cor cor;

	@ManyToOne
	private Usuario usuario;

	private String opcionais;

	public Long getId() {
		return id;
	}

	public String getModelo() {
		return modelo;
	}

	public Date getAnomodelo() {
		return anomodelo;
	}

	public Date getAnofabricacao() {
		return anofabricacao;
	}

	public Double getValor() {
		return valor;
	}

	public Tipo getTipo() {
		return tipo;
	}

	public Marca getMarca() {
		return marca;
	}

	public Cor getCor() {
		return cor;
	}

	public Usuario getUsuario() {
		return usuario;
	}

	public String getOpcionais() {
		return opcionais;
	}

}
