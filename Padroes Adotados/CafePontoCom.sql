-- MySQL Script generated by MySQL Workbench
-- seg 24 ago 2020 17:09:54 -03
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema cafepontocom
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema cafepontocom
-- -----------------------------------------------------

CREATE SCHEMA IF NOT EXISTS `cafepontocom` DEFAULT CHARACTER SET utf8 ;
USE `cafepontocom` ;

create user if not exists 'cafepontocommanager'@'localhost' identified by 'admin';
grant all privileges on 'cafepontocom'.* to 'cafepontocommanager'@'localhost';

-- -----------------------------------------------------
-- Table `cafepontocom`.`Usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cafepontocom`.`Usuario` (
  `idUsuario` INT NOT NULL AUTO_INCREMENT,
  `CPF` CHAR(11) NOT NULL,
  `Nome` VARCHAR(100) NOT NULL,
  `Telefone` VARCHAR(11) NOT NULL,
  `Endereco` VARCHAR(100) NOT NULL,
  `Email` VARCHAR(100) NOT NULL,
  `Admin` TINYINT(1) NOT NULL,
  `Qtd_Vendas` INT NULL,
  `Valor_Comissao` FLOAT NULL,
  `senha` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idUsuario`),
  UNIQUE INDEX `Email_UNIQUE` (`Email` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cafepontocom`.`Produto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cafepontocom`.`Produto` (
  `idProduto` INT NOT NULL AUTO_INCREMENT,
  `Nome` VARCHAR(45) NOT NULL,
  `Descricao` VARCHAR(45) NOT NULL,
  `Preco` VARCHAR(45) NOT NULL,
  `Quantidade` VARCHAR(45) NOT NULL,
  `addedBy` INT NOT NULL,
  PRIMARY KEY (`idProduto`, `addedBy`),
  INDEX `fk_Produto_Usuario1_idx` (`addedBy` ASC),
  CONSTRAINT `fk_Produto_Usuario1`
    FOREIGN KEY (`addedBy`)
    REFERENCES `cafepontocom`.`Usuario` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cafepontocom`.`Venda`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cafepontocom`.`Venda` (
  `idVenda` INT NOT NULL AUTO_INCREMENT,
  `idUsuario` INT NOT NULL,
  `Valor_Total` FLOAT NOT NULL,
  `Valor_Pago` INT NOT NULL,
  `Tipo_Transacao` INT NOT NULL,
  `Concluida` TINYINT(1) NULL,
  PRIMARY KEY (`idVenda`),
  INDEX `fk_Venda_Usuario1_idx` (`idUsuario` ASC),
  CONSTRAINT `fk_Venda_Usuario1`
    FOREIGN KEY (`idUsuario`)
    REFERENCES `cafepontocom`.`Usuario` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cafepontocom`.`Pedido`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cafepontocom`.`Pedido` (
  `idPedido` INT NOT NULL AUTO_INCREMENT,
  `idVenda` INT NOT NULL,
  `idProduto` INT NOT NULL,
  `qtdProduto` INT NOT NULL,
  INDEX `fk_Venda_has_Produto_Produto1_idx` (`idProduto` ASC),
  INDEX `fk_Venda_has_Produto_Venda_idx` (`idVenda` ASC),
  PRIMARY KEY (`idPedido`),
  UNIQUE INDEX `idPedido_UNIQUE` (`idPedido` ASC),
  CONSTRAINT `fk_Venda_has_Produto_Venda`
    FOREIGN KEY (`idVenda`)
    REFERENCES `cafepontocom`.`Venda` (`idVenda`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Venda_has_Produto_Produto1`
    FOREIGN KEY (`idProduto`)
    REFERENCES `cafepontocom`.`Produto` (`idProduto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
