<?php
/**
 *
 * Core of address management for instant litecoin wallet
 *
 * @author Someguy123 AKA Derpz0r
 * @copyright 2011
 *
 */

class Address
{
  public $sqlogin; // Login information and database information
  public $PDO_Conn; // PDO Connection
  public $genaddr; // Generated address
  public $ltc; // Litecoin server connection
  public $secret; // A salt we add for a nice secure URL
  public $securl; // Output URL string
  public $prepd;

  function __construct($btcclient, $sqllogin) {
    $this->ltc = $btcclient;

    try
    {
      $this->PDO_Conn = new PDO("mysql:host={$sqllogin['host']};dbname={$sqllogin['dbname']}", $sqllogin['username'], $sqllogin['password']);
      $this->PDO_Conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (exception $e)
    {
      echo die("An error has occured while connecting to the database, please contact an admin and let them know: " . $e->getMessage());
    }
  }
  function verKey($key)
  {
    $prepkey = $this->PDO_Conn->prepare('SELECT ltcaddress FROM instaltc WHERE url=?');
    if ($key)
    {
      $prepkey->execute(array($key));
      switch ($prepkey->rowCount())
      {
        case 1:
          $b = $prepkey->fetchAll();
          return $b[0]['ltcaddress'];
          break;
        case 0:
          return false;
          break;
        default:
          return "DUPLICATE OR STRANGE ERROR!";
      }
    } else
    return false;
  }
  function newAddr()
  {
    $this->securl = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',5)),0,20); // Generate salt (20 chars))
    $this->genaddr = $this->ltc->getaccountaddress($this->securl); // Generate a new address and shove it in a variable
    // $this->securl = hash('sha512', $this->secret . $this->genaddr . $this->secret);
    try
    {
      $prepd = $this->PDO_Conn->prepare('INSERT INTO instaltc (ltcaddress, url) VALUES (?, ?)'); // Prepare PDO query
      $prepd->execute(array($this->genaddr, $this->securl));
      return $this->genaddr;
    }
    catch (exception $e)
    {
      echo die("Unable to insert into database, please contact an admin and let them know: " . $e->getMessage());
    }
  }

  function sanitizedSend($to_address, $ltcaddr, $key, $amount, $minleft = 0.1, $minfee = 0, $feeperc = 2.5, $feeacc = "Fees")
  {
    if (filter_var($amount, FILTER_VALIDATE_FLOAT))
    {

      $balance = $this->ltc->getbalance("$key");
      if($balance - $amount - $minleft <= 0) { throw new Exception('LOW_BALANCE'); }

      $valid = $this->ltc->validateaddress($to_address);
      if ($valid['isvalid'] == true)
      {
        try
        { // Can we send it?
          $this->ltc->sendfrom($key, $to_address, $amount);
          return array(   'address' => $to_address,
          'account' => $key,
          'amount' => $amount);
        }
        catch (BitcoinClientException $e)
        {
          throw new Exception("SEND_FAILED");
          $btclog = fopen("ltcerror.txt", a);
          fwrite($btclog, "[ {$ltcaddr} ] - " . $e . "\r\n");
        }
      } else
      {
        throw new Exception("INVALID_ADDR");
        $btclog = fopen("ltcerror.txt", 'a');
        fwrite($btclog, "[ {$ltcaddr} ] ENTERED {$to_address}] - INVALID ADDRESS\r\n");
      }
    } else
    {
      throw new Exception("INVALID_AMT");
      $btclog = fopen("ltcerror.txt", 'a');
      fwrite($btclog, "[ {$ltcaddr} ] ENTERED {$amount}] - INVALID AMOUNT\r\n");
    }
  }
}
?>