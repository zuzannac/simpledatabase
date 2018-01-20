Funkcje aplikacji:
We wszystkich poniższych format wyświetlenia osoby to:
ID. Imię Nazwisko - (język1, język2, ...)
Np.
1. Jan Kowalski - (php, java)
2. Piotr Nowak - (c++, php)

1. Lista osób
./demo.php list
Wyświetla wszystkie osoby i ich umiejętności

2. Wyszukiwanie osób po imieniu i nazwisku (również po
fragmencie):
./demo.php find "Kowalski"
./demo.php find "Jan"
./demo.php find "Jan Kowalski"
./demo.php find "Jan K"
./demo.php find "an Kowal"
Wyświetla wszystkie osoby pasujące do kryterium wyszukiwania.

3. Osoby posiadające dane umiejętności
./demo.php languages php java
Wyświetla osoby posiadające wszystkie wyszukiwane języki

4. Dodawanie osoby
./demo.php addPerson Imię Nazwisko język1 język2 język3 ...

5. Usuwanie osoby
./demo.php removePerson ID

6. Dodawanie języka
./demo.php addLanguage nazwa

7. Usuwanie języka
./demo.php removeLanguage nazwa
