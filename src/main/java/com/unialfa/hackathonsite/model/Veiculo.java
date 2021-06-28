package com.unialfa.hackathonsite.model;

import java.util.Date;

import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.Id;
import javax.persistence.ManyToOne;

@Entity
public class Veiculo {
	@Id
	@GeneratedValue(strategy = GenerationType.IDENTITY)
	private Long id;
	private String modelo;
	private Date anomodelo;
	private Date anofabricacao;
	private String valor;
	private String tipo;
	private String foto;
	private String opcionais;

	@ManyToOne
	private Marca marca;

	@ManyToOne
	private Cor cor;

	@ManyToOne
	private Usuario usuario;

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

	public String getValor() {
		return valor;
	}

	public String getTipo() {
		return tipo;
	}

	public String getFoto() {
		return foto;
	}

	public String getOpcionais() {
		return opcionais;
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

}
