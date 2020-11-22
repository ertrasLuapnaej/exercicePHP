<?php
namespace src\Model;

class Commentaire{
    private $Id;
    private $Corps;
    private $Mail;
    private $Auteur;
    private $Date;
    private $Article_Id;


public function SqlAdd(\PDO $bdd, $articleId){
    try{
        $date=new \DateTime();
        $requete=$bdd->prepare("INSERT INTO commentaire (Corps, Auteur, Mail, Date, Article_Id) VALUES(:Corps, :Auteur, :Mail, :Date, :Article_Id)");
        $requete->execute([
            "Corps"=>$this->getCorps(),
            "Auteur"=>$this->getAuteur(),
            "Mail"=>$this->getMail(),
            "Date"=> $this->getDate(),
            "Article_Id"=>$articleId,
        ]);
        return $bdd->lastInsertId();
    }catch (\Exception $e){
        return $e->getMessage();
    }
}

public function SqlUpdate(\PDO $bdd, $id ){
    try{
        $requete = $bdd->prepare("UPDATE commentaire set Corps=:Corps, Auteur=:Auteur, Mail=:Mail, Date=:Date WHERE Id=:Id ");
        $date = new \DateTime();
        $requete->execute([
            "Corps"=>$this->getCorps(),
            "Auteur"=>$this->getAuteur(),
            "Mail"=>$this->getMail(),
            "Id" => $id,
            "Date" => $date->format('Y-m-d'),
        ]);
    }catch(\Exception $e){
        return $e->getMessage();
    }
}

public function SqlGetAll(\PDO $bdd) {
    $requete = $bdd->prepare("SELECT * FROM commentaire");
    $requete->execute();
    $datas = $requete->fetchAll(\PDO::FETCH_CLASS, 'src\Model\Commentaire');
    return $datas;
}

public function SqlGetById(\PDO $bdd, $Article_Id){
    $requete = $bdd->prepare("SELECT * FROM commentaire WHERE Id=:Article_Id");
    $requete->execute([
        "Article_Id"=>$Article_Id,
    ]);
    $requete->setFetchMode(\PDO::FETCH_CLASS,'src\Model\Commentaire');
    $commentaire = $requete->fetch();
    return $commentaire;
}
    
public function SqlDeleteById(\PDO $bdd, $Id){
    $requete = $bdd->prepare("DELETE FROM commentaire WHERE Id=:Id");
    $requete->execute([
        "Id"=> $Id
    ]);
    return true;
}
public function findByArticle(\PDO $bdd, $Id){
    $requete = $bdd->prepare("SELECT * FROM commentaire WHERE Article_Id=:Id");
    $requete->execute([
        "Id" => $Id
    ]);
    $requete->setFetchMode(\PDO::FETCH_CLASS,'src\Model\Commentaire');
    $commentaire = $requete->fetchAll();

    return $commentaire;
}







    /**
     * Get the value of Id
     */ 
    public function getId()
    {
        return $this->Id;
    }

    /**
     * Set the value of Id
     *
     * @return  self
     */ 
    public function setId($Id)
    {
        $this->Id = $Id;

        return $this;
    }

    /**
     * Get the value of Corps
     */ 
    public function getCorps()
    {
        return $this->Corps;
    }

    /**
     * Set the value of Corps
     *
     * @return  self
     */ 
    public function setCorps($Corps)
    {
        $this->Corps = $Corps;

        return $this;
    }

    /**
     * Get the value of Mail
     */ 
    public function getMail()
    {
        return $this->Mail;
    }

    /**
     * Set the value of Mail
     *
     * @return  self
     */ 
    public function setMail($Mail)
    {
        $this->Mail = $Mail;

        return $this;
    }

    /**
     * Get the value of Auteur
     */ 
    public function getAuteur()
    {
        return $this->Auteur;
    }

    /**
     * Set the value of Auteur
     *
     * @return  self
     */ 
    public function setAuteur($Auteur)
    {
        $this->Auteur = $Auteur;

        return $this;
    }

    /**
     * Get the value of Date
     */ 
    public function getDate()
    {
        return $this->Date;
    }

    /**
     * Set the value of Date
     *
     * @return  self
     */ 
    public function setDate($Date)
    {
        $this->Date = $Date;

        return $this;
    }

    /**
     * Get the value of Article_Id
     */ 
    public function getArticle_Id()
    {
        return $this->Article_Id;
    }

    /**
     * Set the value of Article_Id
     *
     * @return  self
     */ 
    public function setArticle_Id($Article_Id)
    {
        $this->Article_Id = $Article_Id;

        return $this;
    }
}