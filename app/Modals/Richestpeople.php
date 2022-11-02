<?php

class PoorPeople
{

  private $db;

  public function __construct()
  {
    $this->db = new Database();
  }

  public function deletePoorPeople($id)
  {
    // var_dump($this->db);
    // exit();
    try {
      $this->db->query('DELETE FROM poorpeople WHERE id = :id');
      $this->db->bind(':id', $id, PDO::PARAM_INT);
      return $this->db->execute();
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }

  public function getPoorPeople()
  {
    $this->db->query('SELECT * FROM poorpeople');
    return $this->db->resultSet();
  }

  public function getSinglePoorPeople($id)
  {
    $this->db->query('SELECT * FROM poorpeople WHERE id = :id');
    $this->db->bind(':id', $id);
    return $this->db->single();
  }

  public function createPoorPeople($post)
  {
    $this->db->query('INSERT INTO `poorpeople` (`id`, `Name`, `Nethworth`, `Age`, `MyCompany`) VALUES (NULL, :namex, :nethworth, :age, :mycompany);');
    $this->db->bind(':namex', $post['Name']);
    $this->db->bind(':nethworth', $post['Nethworth']);
    $this->db->bind(':age', $post['Age']);
    $this->db->bind(':mycompany', $post['MyCompany']);
    return $this->db->execute();
  }
}