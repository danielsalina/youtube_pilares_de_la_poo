# Pilares de la P.O.O. en PHP

Este archivo define una jerarquía de clases para representar diferentes tipos de automóviles en PHP, utilizando conceptos de Programación Orientada a Objetos (POO) como abstracción, encapsulamiento, herencia y polimorfismo.

## Estructura de Clases

### Clase Abstracta `Auto`

La clase abstracta `Auto` proporciona una base para todos los tipos de automóviles. Incluye propiedades comunes como `tipo`, `marca` y `modelo`, y métodos getter para acceder a estas propiedades. También define un método abstracto `arrancar` que debe ser implementado por las subclases y un método común `detener`.

```php
abstract class Auto
{
    public function __construct(
        private string $tipo,
        private string $marca,
        private string $modelo
    ) {}

    public function getTipo(): string { return $this->tipo; }
    public function getMarca(): string { return $this->marca; }
    public function getModelo(): string { return $this->modelo; }

    abstract public function arrancar(): void;

    public function detener(): void
    {
        echo "El " . $this->tipo . " " . $this->marca . " " . $this->modelo . " se ha detenido.<hr>";
    }

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
```

### Clase Abstracta `Camion`

La clase Camion hereda de Auto e incluye una propiedad específica capacidadDeCarga. Implementa el método abstracto arrancar y define un método adicional cargar.

```php
class Camion extends Auto
{
    public function __construct(
        string $tipo,
        string $marca,
        string $modelo,
        private string $capacidadDeCarga
    ) {
        parent::__construct($tipo, $marca, $modelo);
    }

    public function getCapacidadDeCarga(): string { return $this->capacidadDeCarga; }

    public function cargar(): void
    {
        echo "El " . $this->getTipo() . " " . $this->getMarca() . " " . $this->getModelo() . " está cargando " . $this->getCapacidadDeCarga() . " kg<br>";
    }

    public function arrancar(): void
    {
        echo "El " . $this->getTipo() . " " . $this->getMarca() . " " . $this->getModelo() . " está arrancando.<br>";
    }
}
```

### Clase Abstracta `AutoDeportivo`

La clase AutoDeportivo hereda de Auto e incluye una propiedad específica velocidadMaxima. Implementa el método abstracto arrancar y define un método adicional mostrarVelocidadMaxima.

```php
class AutoDeportivo extends Auto
{
    public function __construct(
        string $tipo,
        string $marca,
        string $modelo,
        private string $velocidadMaxima
    ) {
        parent::__construct($tipo, $marca, $modelo);
    }

    public function arrancar(): void
    {
        echo "El " . $this->getTipo() . " " . $this->getMarca() . " " . $this->getModelo() . " está arrancando a gran velocidad.<br>";
    }

    public function mostrarVelocidadMaxima(): void
    {
        echo "El " . $this->getTipo() . " " . $this->getMarca() . " " . $this->getModelo() . " tiene una velocidad máxima de " . $this->velocidadMaxima . " km/h.<br>";
    }
}
```

## Uso del Código

### Creación de Instancias y Uso de Métodos

Se pueden crear instancias de las clases Camion y AutoDeportivo y utilizar sus métodos para demostrar polimorfismo y encapsulamiento.

```php
$camion1 = new Camion("Camion", "Mercedes", "Actros", "30.000");
$camion1->arrancar();
$camion1->cargar();
$camion1->detener();

$autoDeportivo1 = new AutoDeportivo("Auto Deportivo", "Ferrari", "488", "330");
$autoDeportivo1->arrancar();
$autoDeportivo1->mostrarVelocidadMaxima();
$autoDeportivo1->detener();
```

### Creación de Instancias desde un Array

El método estático crearDesdeArray permite crear instancias de Camion o AutoDeportivo a partir de un array de datos.

```php
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

$camion2->arrancar();
$camion2->cargar();
$camion2->detener();

$autoDeportivo2->arrancar();
$autoDeportivo2->mostrarVelocidadMaxima();
$autoDeportivo2->detener();
```

### Requisitos

- PHP 7.4 o superior.

### Instalación

1. Clona el repositorio.
2. Asegúrate de tener PHP instalado.
3. Ejecuta el código PHP en tu servidor local o en un entorno de desarrollo compatible.

### Contribución

Si deseas contribuir a este proyecto, por favor realiza un fork del repositorio y envía un pull request con tus mejoras.
