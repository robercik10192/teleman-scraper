# TelemanScraper
Program telewizyjny dla programistów ;)


## O projekcie
teleman-scraper.php jest [web scraperem](https://en.wikipedia.org/wiki/Web_scraping) pobierającym aktualny program TV ze strony teleman.pl. 
Skrypt jest napisany w PHP z użyciem biblioteki [Simple HTML DOM](https://simplehtmldom.sourceforge.io/)
(biblioteka jest dołączona, nie trzeba jej ściągać) <br />
## Użycie

Wystarczy podmienić zmienne ```$kanal``` oraz ```$data```, domyślne wartości to HBO i dzisiejsza data.<br /> 
Lista kanałów znajduje się w pliku [channels.md](https://github.com/robercik10192/teleman-scraper/blob/master/channels.md) <br />
Format daty to Y-m-d, m, istnieje funkcja ```konwertuj_date()```, która pozwala konwertować datę na podany format.<br />
**DOSTĘP DO PROGRAMÓW Z POPRZEDNICH LAT JEST NIEMOŻLIWY!**
<br /><br />
Zwracaną wartością jest JSowa tablica obiektów: <br />

```javascript
[
  {
  "time":"19:00", //czas nadawania
  "nazwa":"Fakty", //nazwa programu
  "typ":"magazyn informacyjny", //typ programu
  "opis":"Najważniejsze informacje o tym, co wydarzyło się mijającego dnia w kraju i za granicą. Program zawiera reporterskie relacje i komentarze." //krótki opis
  }
]
```
<br /><br />

**DISCLAMER!<br />
Nie odpowiadam za szkody wynikłe z używania tego programu, nadmierne korzystanie może obciążyć stronę co może skutkować konsekwencjami wobec użytkownika.**
