package com.unialfa.hackathonsite.repository;

import java.util.List;


import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Query;
import org.springframework.data.repository.query.Param;

import com.unialfa.hackathonsite.model.Veiculo;

public interface VeiculoRepository extends JpaRepository<Veiculo, Long> {
	List<Veiculo> findByTipo(String tipo);

	@Query(nativeQuery = true, value = "SELECT * FROM Veiculo v ORDER BY RAND() LIMIT :limit")
	List<Veiculo> findByRand(@Param("limit") int limit);
}
