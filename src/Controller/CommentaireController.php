<?php

namespace src\Controller;

use Doctrine\Common\Lexer\AbstractLexer;
use src\Model\Article;
use src\Model\BDD;
use src\Model\Categorie;
use src\Model\Commentaire;

class CommentaireController extends AbstractController
{

    public function All()
    {
        $commentaires = new Commentaire();
        $datas = $commentaires->SqlGetAll(BDD::getInstance());

        return $this->twig->render("Commentaire/all.html.twig", ["commentaire" => $datas]);
    }

    public function Show($id)
    {
        $commentaires = new Commentaire();
        $datas = $commentaires->SqlGetById(BDD::getInstance(), $id);

        return $this->twig->render("Commentaire/show.html.twig", ["commentaire" => $datas]);
    }

    public function Delete($id){
        $commentaires = new Commentaire();
        $commentaire = $commentaires->SqlGetById(BDD::getInstance(),$id); 
        $article = $commentaire->getArticle_Id();
        $datas = $commentaires->SqlDeleteById(BDD::getInstance(),$id);
      header("Location:/Article/Show/$article ");
    }

    
    public function Update($id){
        $commentaires = new Commentaire();
        $commentaire = $commentaires->SqlGetById(BDD::getInstance(),$id);
        $article = $commentaire->getArticle_Id();
        if ($_POST) {
            $commentaire->setCorps($_POST["Corps"]);
            $commentaire->setMail($_POST["Mail"]);
            $commentaire->setAuteur($_POST["Auteur"]);
            //exécuter la maj
            $error = $commentaire->SqlUpdate(BDD::getInstance(), $id);
            $commentaire->SqlUpdate(BDD::getInstance(), $id);

            header("Location:/Article/show/$article");
        }else{
            return $this->twig->render("Commentaire/update.html.twig",["commentaire"=>$commentaire]);
        }
    }
}
