<?php
namespace Library\Models;
 
use \Library\Entities\Matiere;
 
class MatiereManager_PDO extends MatiereManager
{
	public function getUnique($id)
	{
		$requete = $this->dao->prepare('SELECT id_m AS id, libelle, icon
			FROM matiere
			WHERE id_m = :id');
		$requete->bindValue(':id', $id, \PDO::PARAM_INT);
		$requete->execute();
     
		$requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Library\Entities\Matiere');
     
		if ($matiere = $requete->fetch())
		{
			return $matiere;
		}
     
		return null;
	}
	
	public function getList()
	{
		$sql = 'SELECT id_m, libelle, icon
			FROM matiere
			ORDER BY libelle';
     
		$requete = $this->dao->query($sql);
		$requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Library\Entities\Matiere');
     
		$listeMatiere = $requete->fetchAll();
     
		$requete->closeCursor();
     
		return $listeMatiere;
	}
	
	public function getByName($libelle) {
		
		$requete = $this->dao->prepare('SELECT id_m AS id, libelle, icon FROM matiere WHERE libelle = :libelle');
		$requete->bindValue(':libelle', $libelle, \PDO::PARAM_STR);
		$requete->execute();
 
		$requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Library\Entities\Matiere');
 
		if ($matiere = $requete->fetch())
		{
			return $matiere;
		}
 
		return null;
	}
	
	protected function add(Matiere $matiere)
	  {
	    $requete = $this->dao->prepare('INSERT INTO matiere SET libelle = :libelle');
     
	    $requete->bindValue(':libelle', $matiere->libelle());
     
	    $requete->execute();
	  }
}