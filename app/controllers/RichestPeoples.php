<?php

class PoorPeoples extends Controller
{
  public function __construct()
  {
    // setting model to controller
    $this->poorPeopleModal = $this->modal('PoorPeople');
  }

  public function index()
  {
    // Getting alle the poor people from database
    $records = $this->poorPeopleModal->getPoorPeople();

    // creating data to view
    $data = [
      'title' => 'Armste mensen van de wereld',
      'records' => $records
    ];

    // setting data to view
    $this->view('PoorPeople/index', $data);
  }

  // poorpeoples/delete
  public function delete($id = null)
  {
    // if it doesn't exist redirect to /poorpeoples
    if (!isset($id)) {
      header('Location: ' . URLROOT . '/PoorPeoples');
    }

    // deleting person from db with $id form url
    $this->poorPeopleModal->deletePoorPeople($id);

    // creating data to view with messages and the id from the url
    $data = [
      'message' => 'Het record met id ' . $id .  ' is verwijderd',
    ];

    // setting data to the view
    $this->view('PoorPeople/message', $data);
  }

  // poorpeoples/create
  public function create()
  {
    var_dump($_POST);

    // check if method is post or else redirect to /PoorPeoples
    if ($_SERVER['REQUEST_METHOD'] != 'POST') {
      header('Location: ' . URLROOT . '/PoorPeoples');
      return;
    }

    // inserting data into db
    $this->poorPeopleModal->createPoorPeople($_POST);

    // creating data to view with messages and the id from the url
    echo 'je wordt over 5 seconden terug gestuurd';
    header('Refresh: 5; URL=' . URLROOT . '/PoorPeoples');
  }
}

?>
//PoorPeoples