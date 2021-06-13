package com.unialfa.hackathonsite.controller;

import javax.websocket.server.PathParam;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.RequestMapping;

import com.unialfa.hackathonsite.repository.VeiculoRepository;

@Controller
public class IndexController {

	@Autowired
	private VeiculoRepository veiculoRepository;

	@RequestMapping("/")
	public String index(Model model) {
		model.addAttribute("veiculos", veiculoRepository.findByRand(6));

		return "index";
	}

	@RequestMapping("/sobre")
	public String sobre(Model model) {

		return "sobre";
	}

	@RequestMapping("/veiculos/{tipo}")
	public String tipos(@PathVariable String tipo, Model model) {
		model.addAttribute("veiculos", veiculoRepository.findByTipo(tipo));
		model.addAttribute("tipo", tipo);

		return "veiculos/tipo";
	}
	
	@RequestMapping("/veiculo/detalhe")
	public String detalhes(@PathParam(value = "id") Long id, Model model) {
		model.addAttribute("veiculo", veiculoRepository.getById(id));

		return "veiculos/detalhe";
	}
}
