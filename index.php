<?php

// Definición de nuestra clase abstracta Auto (abstracción y encapsulamiento)
abstract class Auto
{
  // Constructor con promoción de propiedades
  public function __construct(
    private string $tipo,
    private string $marca,
    private string $modelo
  ) {
  }

  // Métodos getter para acceder a las propiedades (encapsulamiento)
  public function getTipo(): string
  {
    return $this->tipo;
  }

  public function getMarca(): string
  {
    return $this->marca;
  }

  public function getModelo(): string
  {
    return $this->modelo;
  }

  // Método abstracto que debe ser implementado por las subclases (abstracción)
  abstract public function arrancar(): void;

  // Método común a todas las subclases
  public function detener(): void
  {
    echo "El " . $this->tipo . " " . $this->marca . " " . $this->modelo . " se ha detenido.<hr>";
  }

  // Método estático para crear una instancia a partir de un array de datos
  public static function crearDesdeArray(array $datos): Auto
  {
    switch ($datos['tipo']) {
      case 'Camion':
        return new Camion(
          $datos['tipo'],
          $datos['marca'],
          $datos['modelo'],
          $datos['capacidadDeCarga']
        );
      case 'Auto Deportivo':
        return new AutoDeportivo(
          $datos['tipo'],
          $datos['marca'],
          $datos['modelo'],
          $datos['velocidadMaxima']
        );
      default:
        throw new InvalidArgumentException('Tipo de vehículo no soportado.');
    }
  }
}

// Definición de nuestra clase Camion que hereda de nuestra clase Auto (herencia)
class Camion extends Auto
{
  // Constructor con promoción de propiedades
  public function __construct(
    string $tipo,
    string $marca,
    string $modelo,
    private string $capacidadDeCarga
  ) {
    parent::__construct($tipo, $marca, $modelo);
  }

  // Método getter para la capacidad de carga (encapsulamiento)
  public function getCapacidadDeCarga(): string
  {
    return $this->capacidadDeCarga;
  }

  // Método específico de la clase Camion
  public function cargar(): void
  {
    echo "El " . $this->getTipo() . " " . $this->getMarca() . " " . $this->getModelo() . " está cargando " . $this->getCapacidadDeCarga() . " kg<br>";
  }

  // Implementación del método abstracto arrancar (abstracción)
  public function arrancar(): void
  {
    echo "El " . $this->getTipo() . " " . $this->getMarca() . " " . $this->getModelo() . " está arrancando.<br>";
  }
}

// Definición de nuestra clase AutoDeportivo que hereda de Auto (herencia)
class AutoDeportivo extends Auto
{
  // Constructor con promoción de propiedades
  public function __construct(
    string $tipo,
    string $marca,
    string $modelo,
    private string $velocidadMaxima
  ) {
    parent::__construct($tipo, $marca, $modelo);
  }

  // Implementación del método abstracto arrancar (abstracción)
  public function arrancar(): void
  {
    echo "El " . $this->getTipo() . " " . $this->getMarca() . " " . $this->getModelo() . " está arrancando a gran velocidad.<br>";
  }

  // Método específico de AutoDeportivo
  public function mostrarVelocidadMaxima(): void
  {
    echo "El " . $this->getTipo() . " " . $this->getMarca() . " " . $this->getModelo() . " tiene una velocidad máxima de " . $this->velocidadMaxima . " km/h.<br>";
  }
}

// Creación de una instancia de la clase Camion (instanciación)
$camion1 = new Camion("Camion", "Mercedes", "Actros", "30.000");

// Acceso a los métodos de la instancia (polimorfismo y encapsulamiento)
$camion1->arrancar();
$camion1->cargar();
$camion1->detener();

// Creación de una instancia de la clase AutoDeportivo (instanciación)
$autoDeportivo1 = new AutoDeportivo("Auto Deportivo", "Ferrari", "488", "330");

// Acceso a los métodos de la instancia (polimorfismo y encapsulamiento)
$autoDeportivo1->arrancar();
$autoDeportivo1->mostrarVelocidadMaxima();
$autoDeportivo1->detener();

// Creación de instancias a partir de un array de datos utilizando el método estático
$datosCamion = [
  'tipo' => 'Camion',
  'marca' => 'Volvo',
  'modelo' => 'FH',
  'capacidadDeCarga' => "25.000"
];

$datosAutoDeportivo = [
  'tipo' => 'Auto Deportivo',
  'marca' => 'Lamborghini',
  'modelo' => 'Huracan',
  'velocidadMaxima' => 325
];

/** @var Camion $camion2 */
$camion2 = Auto::crearDesdeArray($datosCamion);
/** @var AutoDeportivo $autoDeportivo2 */
$autoDeportivo2 = Auto::crearDesdeArray($datosAutoDeportivo);

// Acceso a los métodos de las nuevas instancias
$camion2->arrancar();
$camion2->cargar();
$camion2->detener();

$autoDeportivo2->arrancar();
$autoDeportivo2->mostrarVelocidadMaxima();
$autoDeportivo2->detener();
