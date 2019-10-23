AlleKurier API v1
========================

- [Wymagania](#wymagania)
- [Instalacja](#instalacja)
- [Użycie](#użycie)
    - [Przygotowanie API](#przygotowanie-api)
    - [Utworzenie zamówienia](#utworzenie-zamówienia)
    - [Pobranie aktualnego statusu przesyłki](#pobranie-aktualnego-statusu-przesyłki)
    - [Pobranie listu przewozowego](#pobranie-listu-przewozowego)
    - [Pobranie historii przesyłki](#pobranie-historii-przesyłki)
    - [Anulowanie zamówienia](#anulowanie-zamówienia)
    - [Pobranie usług](#pobranie-usług)
    - [Pobranie dodatkowych usług](#pobranie-dodatkowych-usług)
    - [Pobranie godzin odbioru](#pobranie-godzin-odbioru)
    - [Pobranie punktów przewoźnika](#pobranie-punktów-przewoźnika)
- [Modele](#modele)
    - [Request](#request)
        - [Order](#order)
        - [Sender / Recipient](#sender---s--recipient---r)
        - [Pickup](#pickup)
        - [Package](#package-typ-opakowania)
    - [Response](#response)
        - [Service](#service)
        - [DropoffPoint](#dropoffpoint)
        - [PickupDate](#pickupdate)
        - [Event](#event)
- [Słownik](#słownik)

Wymagania
------------

  * PHP 5.4.0 lub wyższy;
  * ext-json;
  * ext-curl;


Instalacja
------------

Composer:

```bash
composer require allekurier/api_v1
```

Zip:

```php
require __DIR__ . '/my_path/allekurier/api_v1/AutoLoader.php';

allekurier\api_v1\AutoLoader::init(__DIR__ . '/my_path');
```

Użycie
-----

### Przygotowanie API

```php
$credentials = new allekurier\api_v1\Credentials('login', 'hasło');
$api = new allekurier\api_v1\AKAPI($credentials);
```

### Utworzenie zamówienia
Funkcja zwraca HID zlecenia, numer listu przewozowego, aktualny status, koszt przesyłki.

Poprawnym wyjściem jest status ready. W sytuacji gdy zwrócony status będzie równał się processing należy zapisać HID zlecenia i w określonym interwale czasowym sprawdzać (funkcja getStatus) czy zlecenie zostało już przetworzone, aby kontynuować przetwarzanie (pobranie i wydruk dokumentów).
Przyczyną stanu processing może np. być awaria systemu przewoźnika.

```php
$order = new allekurier\api_v1\model\Order(
    'nazwa usługi',
    'typ opakowania',
    'opis przesyłki',
    'metoda odbioru',
    'kwota pobrania',
    'kwota ubezpieczenia',
    'wartość towaru',
    'voucher'
);

$sender = new allekurier\api_v1\model\Sender(
    'nazwa nadawcy',
    'osoba kontaktowa',
    'kod pocztowy',
    'adres',
    'miasto',
    'telefon',
    'email',
    'kod państwa',
    'punkt przewoźnika',
    'numer konta bankowego'
);

$recipient = new allekurier\api_v1\model\Recipient(
    'nazwa odbiorcy',
    'osoba kontaktowa',
    'kod pocztowy',
    'adres',
    'miasto',
    'telefon',
    'email',
    'kod państwa',
    'punkt przewoźnika'
);

// Wymagany gdy Order - metoda odbioru = register
$pickup = new allekurier\api_v1\model\Pickup(
    'data odbioru',
    'od godz',
    'do godz'
);

$packages = new allekurier\api_v1\model\Packages([
    new allekurier\api_v1\model\Package('waga', 'szerokość', 'wysokość', 'długość', 'czy standardowa')
]);

$additionalServices = [
    'sms',
    'email_notif_delivered'
];

$action = new allekurier\api_v1\action\CreateOrderAction(
    $order,
    $sender,
    $recipient,
    $packages,
    $pickup,
    $additionalServices
);

$response = $api->call($action);

if ($response->hasErrors()) {
    var_dump($response->getErrors());
} else {
    echo $response->number();
    echo $response->hid();
    echo $response->cost();
    echo $response->status();
}
```

##### cURL:

```bash
curl -X POST \
  https://allekurier.pl/api_v1/order_create \
  -H 'accept: application/json' \
  -H 'cache-control: no-cache' \
  -H 'content-type: application/x-www-form-urlencoded' \
  -d 'User%5Bemail%5D=*email*
      &User%5Bpassword%5D=*haslo*
      &Order%5Bpackage%5D=*typ_opakowania*
      &Order%5Bcod%5D=*kwota_pobrania*
      &Order%5Binsurance%5D=*kwota_ubezpieczenia*
      &Order%5Bdelivery%5D=*metoda_odbioru*
      &Order%5Bservice%5D=*nazwa_uslugi*
      &Order%5Bdescription%5D=*opis_przesylki*
      &Order%5Bvalue%5D=*wartosc_towaru*
      &Sender%5Bcountry%5D=*kod_kraju*
      &Sender%5Bphone%5D=*telefon*
      &Sender%5Baddress%5D=*adres*
      &Sender%5Bpostal_code%5D=*kod_pocztowy*
      &Sender%5Bperson%5D=*osoba_kontaktowa*
      &Sender%5Bcity%5D=*miasto*
      &Sender%5Bemail%5D=*email*
      &Sender%5Bname%5D=*nadawca*
      &Sender%5Bbank_account%5D=*numer_banku_do_zwrotu_pobrania*
      &Sender%5Bdropoff_point%5D=*kod_punktu_przewoznika*
      &Recipient%5Bcountry%5D=*kod_kraju*
      &Recipient%5Bpostal_code%5D=*kod_pocztowy*
      &Recipient%5Bphone%5D=*telefon*
      &Recipient%5Bcity%5D=*miasto*
      &Recipient%5Bname%5D=*odbiorca*
      &Recipient%5Bperson%5D=*osoba_kontaktowa*
      &Recipient%5Baddress%5D=*adres*
      &Recipient%5Bemail%5D=*email*
      &Package%5B0%5D%5Bweight%5D=*waga_paczki*
      &Package%5B0%5D%5Bheight%5D=*wysokosc_paczki*
      &Package%5B0%5D%5Bwidth%5D=*szerokosc_paczki*
      &Package%5B0%5D%5Blength%5D=*dlugosc_paczki*
      &Package%5B0%5D%5Bcustom%5D=*czy_standardowa*
      &Pickup%5Bdate%5D=*data*
      &Pickup%5Bfrom%5D=*od_godz*
      &Pickup%5Bto%5D=*do_godz*
      &Services%5B0%5D=*nazwa_uslugi*'
```

###### Response:

```json
{
    "Error":[],
    "Response":{
        "hid":"",
        "number":null,
        "cost":"12.76",
        "status":"processing"
    }
}
```

### Pobranie aktualnego statusu przesyłki

Zwraca podstawowe informacja o zleceniu na podstawie jego numeru.
Służy do pobierania ostatniego zdarzenia z historii zlecenia (statusu), numeru, oraz dat (utworzenie, nadanie, doręczenie).

```php
$action = new allekurier\api_v1\action\GetOrderStatusAction('hid przesyłki');

$response = $api->call($action);

if ($response->hasErrors()) {
    var_dump($response->getErrors());
} else {
    echo $response->date();
    echo $response->name();
    echo $response->status();
}
```

##### cURL:

```bash
curl -X POST \
  https://allekurier.pl/api_v1/order_status \
  -H 'accept: application/json' \
  -H 'cache-control: no-cache' \
  -H 'content-type: application/x-www-form-urlencoded' \
  -d 'User%5Bemail%5D=*email*
      &User%5Bpassword%5D=*haslo*
      &hid=*hid*'
```

###### Response:

```json
{
    "Error": [],
    "Response": {
        "Order": {
            "hid": "",
            "number": null,
            "created": "2017-11-16 13:39:58",
            "sent": null,
            "delivered": null,
            "status": "canceled"
        },
        "Event": {
            "date": "2017-11-16 13:41:06",
            "status": "canceled",
            "name": "Anulowane"
        }
    }
}
```

### Pobranie listu przewozowego

Pobieranie dokumentów do wydruku. Funkcja zwraca zakodowany (base64) pdf z listami przewozowymi.
W przypadku DPD domyślnie zwracany jest protokół przekazania towaru.
Dokumenty można drukować tylko gdy status zlecenia ustawiony jest na ready.

```php
$action = new allekurier\api_v1\action\GetOrderLabelAction('numer przesyłki');

$response = $api->call($action);

if ($response->hasErrors()) {
    var_dump($response->getErrors());
} else {
    file_put_contents('my_path/label.pdf', $response->label());
}
```

##### cURL:

```bash
curl -X POST \
  https://allekurier.pl/api_v1/order_label \
  -H 'accept: application/json' \
  -H 'cache-control: no-cache' \
  -H 'content-type: application/x-www-form-urlencoded' \
  -d 'User%5Bemail%5D=*email*
      &User%5Bpassword%5D=*haslo*
      &number=*numer_przesylki*'
```

###### Response:

```json
{
    "Error":[],
    "Response":{
        "Order":{
            "hid":"",
            "number":"",
            "status":"ready"
        },
        "label":""
    }
}
```

### Pobranie historii przesyłki

Śledzenie przesyłki. Zwracana jest data każdego zdarzenia, kod oraz opis.
Dodatkowo podawane są HID zlecenia, data utworzenia, faktycznego nadania oraz doręczenia (lub zwrotu do nadawcy).
Zwraca tablicę zdarzeń [Event](#event)

```php
$action = new allekurier\api_v1\action\GetOrderHistoryAction('numer przesyłki');

$response = $api->call($action);

if ($response->hasErrors()) {
    var_dump($response->getErrors());
} else {
    foreach ($response->history() as $event) {
        echo $event->date();
        echo $event->name();
        echo $event->status();
    }
}
```

##### cURL:

```bash
curl -X POST \
  https://allekurier.pl/api_v1/order_history \
  -H 'accept: application/json' \
  -H 'cache-control: no-cache' \
  -H 'content-type: application/x-www-form-urlencoded' \
  -d 'User%5Bemail%5D=*email*
      &User%5Bpassword%5D=*haslo*
      &number=*numer_przesylki*'
```

###### Response:

```json
{
    "Error": [],
    "Response": {
        "Order": {
            "hid": "",
            "number": "",
            "created": "2017-11-14 11:49:11",
            "sent": null,
            "delivered": null
        },
        "Event": [
            {
                "date": "2017-11-14 11:49:11",
                "status": "created",
                "name": "Zlecenie utworzone"
            },
            ...
        ]
    }
}
```

### Anulowanie zamówienia

Anulowanie zlecenia na podstawie numeru. Listy przewozowe UPS należy bezwzględnie anulować,
nawet w sytuacji gdy kurier nie odbierze przesyłki (mimo to naliczana jest opłata za transport!).
Przyjmujemy że bez względu na przewoźnika list przewozowy należy anulować.
Anulowanie listu powoduje anulowanie zlecenia odbioru z danej lokalizacji.

```php
$action = new allekurier\api_v1\action\CancelOrderAction('numer przesyłki');

$response = $api->call($action);

if ($response->hasErrors()) {
    var_dump($response->getErrors());
} else {
    if ($response->isCanceled()) {
        echo 'Anulowane';
    }
}
```

##### cURL:

```bash
curl -X POST \
  https://allekurier.pl/api_v1/order_cancel \
  -H 'accept: application/json' \
  -H 'cache-control: no-cache' \
  -H 'content-type: application/x-www-form-urlencoded' \
  -d 'User%5Bemail%5D=*email*
      &User%5Bpassword%5D=*haslo*
      &number=*numer_przesylki*'
```

###### Response:

```json
{
    "Error": [],
    "Response": {
        "status": 1
    }
}
```

### Pobranie usług

Metoda zwraca dostępne usługi wraz z kwotami dla podanych danych.
Zwraca tablicę usług [Service](#service)

```php
$order = allekurier\api_v1\model\Order::createForPricing(
    'typ opakowania',
    'kwota pobrania',
    'kwota ubezpieczenia'
);

$sender = allekurier\api_v1\model\Sender::createForPricing(
    'kod państwa',
    'kod pocztowy tylko dla palet'
);

$recipient = allekurier\api_v1\model\Recipient::createForPricing(
    'kod państwa',
    'kod pocztowy tylko dla palet'
);

$packages = new allekurier\api_v1\model\Packages([
    new allekurier\api_v1\model\Package('waga', 'szerokość', 'wysokość', 'długość', 'czy standardowa')
]);

$action = new allekurier\api_v1\action\GetServicesAction($order, $sender, $recipient, $packages);

$response = $api->call($action);

if ($response->hasErrors()) {
    var_dump($response->getErrors());
} else {
    foreach ($response->services() as $service) {
        echo $service->carrierCode();
        echo $service->carrierName();
        echo $service->code();
        echo $service->name();
        echo $service->net();
        echo $service->gross();
    }
}
```

### Pobranie dodatkowych usług

Metoda zwraca dostępne dodatkowe usługi danej usługi wraz z kwotami dla podanych danych.
Zwraca tablicę usług dodatkowych [AdditionalService](#additionalservice)

```php
$action = new allekurier\api_v1\action\GetAdditionalServicesAction('nazwa uslugi', 'typ opakowania');

$response = $api->call($action);

if ($response->hasErrors()) {
    var_dump($response->getErrors());
} else {
    foreach ($response->services() as $service) {
        echo $service->code();
        echo $service->name();
        echo $service->net();
    }
}
```

##### cURL:

```bash
curl -X POST \
  https://allekurier.pl/api_v1/additional_services \
  -H 'accept: application/json' \
  -H 'cache-control: no-cache' \
  -H 'content-type: application/x-www-form-urlencoded' \
  -d 'User%5Bemail%5D=*email*
      &User%5Bpassword%5D=*haslo*
      &service=*kod_uslugi*
      &package=*typ_opakowania*'
```

###### Response:

```json
{
    "Error": [],
    "Response": {
        "cod_instant": {
            "name": "Pobranie Natychmiastowe (1 dzień)",
            "price": "2.00"
        },
        "rod": {
            "name": "Zwrot dokumentów",
            "price": "13.00"
        }
    }
}
```

### Pobranie godzin odbioru

Metoda zwraca możliwe godziny odbioru przesyłki przez danego przewoźnika dla zadanego kodu pocztowego.
Tablica „from” określa godziny startowe okienka na odbiór, tablica „to” zawiera możliwe końce okienek,
Wartości liczone w sekundach od północy np. godzina 11:00 = 11 * 3600 = 39600.
Zwaraca tablicę dat [PickupDate](#pickupdate)

```php
$action = new allekurier\api_v1\action\GetPickupDatesAction('przewoźnik', 'kod pocztowy', 'kod państwa');

$response = $api->call($action);

if ($response->hasErrors()) {
    var_dump($response->getErrors());
} else {
    foreach ($response->dates() as $date) {
        echo $date->date();
        echo $date->description();
        var_dump($date->from());
        var_dump($date->to());
    }
}
```

##### cURL:

```bash
curl -X POST \
  https://allekurier.pl/api_v1/pickup_dates \
  -H 'accept: application/json' \
  -H 'cache-control: no-cache' \
  -H 'content-type: application/x-www-form-urlencoded' \
  -d 'User%5Bemail%5D=*email*
      &User%5Bpassword%5D=*haslo*
      &carrier=*przewoznik*
      &postal_code=*kod_pocztowy*
      &country=*kod_kraju*'
```

###### Response:

```json
{
    "Error": [],
    "Response": [
        {
            "date": "2017-11-16",
            "description": "Dzisiaj",
            "from": {
                "41400": "11:30",
                "43200": "12:00"
            },
            "to": {
                "57600": "16:00"
            },
            "to_minima": {
                "41400": 57600,
                "43200": 57600
            },
            "call_to": 43200,
            "class": "todayPickupDate",
            "call_to_formatted": "12:00"
        },
        ...
    ]
}
```

### Pobranie punktów przewoźnika

Metoda zwraca punkty wybranego przewoźnika w okolicy od podanego kodu pocztowego.
Zwraca tablicę punktów [DropoffPoint](#dropoffpoint)

```php
$action = new allekurier\api_v1\action\GetDropoffPointsAction('przewoźnik', 'kod pocztowy');

$response = $api->call($action);

if ($response->hasErrors()) {
    var_dump($response->getErrors());
} else {
    foreach ($response->points() as $point) {
        echo $point->id();
        echo $point->latitude();
        echo $point->longitude();
        echo $point->name();
        echo $point->code();
        echo $point->address();
        echo $point->postalCode();
        echo $point->image();
        echo $point->openHours();
        echo $point->isSupportCod();
    }
}
```

##### cURL:

```bash
curl -X POST \
  https://allekurier.pl/api_v1/access_points \
  -H 'accept: application/json' \
  -H 'cache-control: no-cache' \
  -H 'content-type: application/x-www-form-urlencoded' \
  -d 'User%5Bemail%5D=*email*
      &User%5Bpassword%5D=*haslo*
      &carrier=*przewoznik*
      &postal_code=*kod_pocztowy*'
```

###### Response:

```json
{
    "Error":[],
    "Response":{
        "Coordinates":{
            "longitude":"",
            "latitude":""
        },
        "AccessPoints":[
            {
                "AccessPoints":{
                    "id":"",
                    "latitude":"",
                    "longitude":"",
                    "code":"",
                    "name":"",
                    "address":"",
                    "address2":null,
                    "postal_code":"",
                    "city":"",
                    "image_url":null,
                    "open_hours":null,
                    "cod":"0"
                },
                "0":{
                    "diff":""
                }
            },
            ...
        ]
    }
}
```

### Pobranie środków użytkownika

Metoda zwraca stan konta użytkownika

```php
$action = new allekurier\api_v1\action\GetUserBalanceAction;

$response = $api->call($action);

if ($response->hasErrors()) {
    var_dump($response->getErrors());
} else {
    echo $response->balance();
}
```

##### cURL:

```bash
curl -X POST \
  https://allekurier.pl/api_v1/user_balance \
  -H 'accept: application/json' \
  -H 'cache-control: no-cache' \
  -H 'content-type: application/x-www-form-urlencoded' \
  -d 'User%5Bemail%5D=*email*
      &User%5Bpassword%5D=*haslo*'
```

###### Response:

```json
{
    "Error": [],
    "Response": [
        {
            "User": {
                "hid": "XXXXXX",
                "balance": "0.00",
                "free": "0.00"
            }
        }
    ]
}
```

Modele
-----

#### Request

##### Order

| Pole        | Opis                | Wymagane | Typ     | Opis                                                                                                          |
| ----------- | ------------------- | -------- | ------- | ------------------------------------------------------------------------------------------------------------- |
| service     | Nazwa usługi        | tak      | string  | dpdclassic, dhlstandard, upsexpresssaver, upsstandard, kexstandard, inpostcourier, paczkawruchu               |
| package     | Typ opakowania      | tak      | string  | [parcel, envelope, europallet, isopallet, bigpallet](#typ-opakowania---package)                                     |
| description | Opis przesyłki      | tak      | string  |                                                                                                               |
| delivery    | Metoda odbioru      | tak      | string  | register - Zamawiam kuriera po odbiór przesyłki, <br/>  none - Dostarczę przesyłkę do punktu przewoźnika. |
| cod         | Kwota pobrania      | nie      | float   |                                                                                                               |
| insurance   | Kwota ubezpieczenia | nie      | float   |                                                                                                               |
| value       | Wartość towaru      | nie      | float   | Wymagane przy przesyłkach poza Unię Europejską                                                                |
| voucher     | Kod vouchera        | nie      | string  | &nbsp;                                                                                                        |

##### Sender - S / Recipient - R

| Pole          | Opis                   | Model | Wymagane | Typ    | Opis                                                                 |
| ------------- | ---------------------- | ------| -------- | ------ | -------------------------------------------------------------------- |
| name          | Odbiorca / Nadawca     | S & R | tak      | string | imię nazwisko / nazwa firmy                                          |
| person        | Osoba kontaktowa       | S & R | tak      | string | imię nazwisko osoby kontakowej                                       |
| postal_code   | Kod pocztowy           | S & R | tak      | string |                                                                      |
| address       | Adres                  | S & R | tak      | string | ulica, numer domu / mieszkania                                       |
| city          | Miasto                 | S & R | tak      | string |                                                                      |
| phone         | Telefon                | S & R | tak      | string |                                                                      |
| email         | Email                  | S & R | tak      | string |                                                                      |
| country       | Kod kraju              | S & R | tak      | string | [ISO 3166-1 alfa-2](https://pl.wikipedia.org/wiki/ISO_3166-1_alfa-2) |
| dropoff_point | Kod punktu przewoźnika | S & R | nie      | string | [Punkty przewoźników](https://allekurier.pl/punkty-odbioru)          |
| bank_account  | Numer konta bankowego  | S     | nie      | string | wymagane gdy podano Order.cod                                        |

##### Pickup

| Pole | Opis         | Wymagane | Typ    | Przykład          |
| -----| ------------ | -------- | ------ | ----------------- |
| date | Data         | tak      | string | 2017-01-20        |
| from | Od godz      | tak      | string | 12:00:00          |
| to   | Do godz      | tak      | string | 16:00:00          |

##### Package ([Typ opakowania](#typ-opakowania-package))

| Pole   | Opis         | Wymagane | Typ   | Opis                                                                        |
| ------ | ------------ | -------- | ----- | --------------------------------------------------------------------------- |
| weight | Waga         | tak      | float |                                                                             |
| width  | Szerokość    | tak      | float |                                                                             |
| height | Wysokość     | tak      | float |                                                                             |
| length | Długość      | tak      | float |                                                                             |
| custom | Czy standard | tak      | bool  | [Paczka standardowa / niestandardowa](https://allekurier.pl/niestandardowa) |

---

#### Response

##### Service

| Pole        | Opis              | Typ      |
| ----------- | ----------------- | -------- |
| carrierCode | Kod przewoźnika   | string   |
| carrierName | Nazwa przewoźnika | string   |
| code        | Kod usługi        | string   |
| name        | Nazwa usługi      | string   |
| net         | Koszt netto       | float    |
| gross       | Koszt brutto      | float    |

##### AdditionalService

| Pole        | Opis              | Typ      |
| ----------- | ----------------- | -------- |
| code        | Kod usługi        | string   |
| name        | Nazwa usługi      | string   |
| net         | Koszt netto       | float    |

##### DropoffPoint

| Pole         | Opis                   | Typ      |
| ------------ | ---------------------- | -------- |
| id           | Id punktu              | int      |
| latitude     |                        | string   |
| longitude    |                        | string   |
| name         | Nazwa punktu           | string   |
| code         | Kod punktu             | string   |
| address      | Adres punktu           | string   |
| postalCode   | Kod pocztowy           | string   |
| image        | Zdjęcie punktu         | string   |
| openHours    | Godziny otwarcia       | string   |
| isSupportCod | Czy obsługuje pobrania | bool     |

##### PickupDate

| Pole         | Opis                          | Typ      |
| ------------ | ----------------------------- | -------- |
| date         | Data                          | string   |
| description  | Opis                          | string   |
| from         | Tablica godz podjazdu od godz | array    |
| to           | Tablica godz podjazdu do godz | array    |

##### Event

| Pole         | Opis                   | Typ      |
| ------------ | ---------------------- | -------- |
| name         | Nazwa zdarzenia        | string   |
| date         | Data zdarzenia         | string   |
| status       | Status zdarzenia       | string   |


Słownik
-----

#### Typ opakowania - package

| Kod        | Nazwa             | Max waga  | Szerokość    | Długość      | Wysokość     |
| ---------- | ----------------- | --------- | ------------ | ------------ | ------------ |
| parcel     | Paczka            | 70        | 1 > && < 270 | 1 > && < 300 | 1 > && < 270 |
| envelope   | List              | 0,5       | -            | -            | -            |
| europallet | Paleta 120x80 cm  | 900       | -            | -            | < 180        |
| isopallet  | Paleta 120x100 cm | 900       | -            | -            | < 180        |
| bigpallet  | Paleta 120x120 cm | 900       | -            | -            | < 180        |

#### Przewoźnicy

| Kod           | Nazwa             | Kod usług                                 |
| ------------- | ----------------- | ----------------------------------------- |
| dpd           | Dpd               | dpdclassic                                |
| ups           | Ups               | upsstandard, upsexpresssaver, upsexpress  |
| dhl           | Dhl               | dhlstandard                               |
| inpostcourier | Inpost Kurier     | inpostcourier                             |
| ruch          | Ruch              | paczkawruchu                              |
| poczta        | Poczta Polska     |                                           |
| inpost        | Inpost Paczkomaty | paczkomat                                 |
| fedex         | Fedex Polska      | fedex                                     |
| geis          | Geis Parcel       | kexstandard                               |
