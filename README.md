<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
  <strong>Work Time Tracker</strong> – Laravel REST API do ewidencji czasu pracy
</p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

---

## Endpointy API

### POST `/api/v1/employees`
Tworzy nowego pracownika.

### POST `/api/v1/work-time`
Rejestracja czasu pracy.

## GET `/api/v1/work-time/summary-day`
Podsumowanie dzienne.

## GET `/api/v1/work-time/summary-month`
Podsumowanie miesięczne.


## Parametry konfiguracyjne (config/worktime.php)

Norma miesięczna: 40 godzin
Stawka podstawowa: 20 PLN
Mnożnik nadgodzin: 200%

## Technologie
Laravel 12 (PHP 8.4)
MySQL
