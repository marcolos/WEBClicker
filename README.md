# WEBClicker

## Overview
WEBClicker è una applicazione web che fornisce un servizio aggiuntivo in ambito scolastico a professori e studenti.
L’ app offre ai professori, la possibilità di poter creare e proiettare delle domande riguardanti argomenti del corso
spiegati durante le lezioni agli studenti, i quali attraverso la rete, utilizzando il proprio smartphone, tablet o pc 
possano dare una risposta. Alla fine della votazione il professore può mostare alla classe i risultati,i quali vengono 
riportati su un grafico.

## Implementazione
L'applicazione è stata sviluppata lato client utilizzando HTML5, CSS, JavaScript, oltre alle librerie Bootstap e jQuery.
Per quanto riguarda il lato server è stato utilizzato un Database MySQL contente i dati dell'applicazioni. 
Il DB è stato interrogato mediante linguaggio PHP.
Inoltre sono state utilizzate le API di Google per la creazione del grafici.

## Interfaccia e Funzionalità
Alla pagina iniziale dell’applicazione, viene mostrata la sezione di Login, nella quale un docente, immettendo i propri 
dati personali, viene reindirizzato nella propria pagina personale.

![ ](https://github.com/marcolos/WEBClicker/blob/master/REDMI_img/signin.png)
![ ](https://github.com/marcolos/WEBClicker/blob/master/REDMI_img/prof_main_page.png)

Adesso il professore cliccando sul bottone + potrà inserire una nuova domanda che andrà ad aggiungersi alla lista di 
quelle create precedentemente. Sarà consentito, tramite i due bottoni + e - , inserire domande contenenti un minimo di 2
ed un massimo di 5 possibili risposte. 
L’applicazione offre anche la possibilità di rimuovere e modificare delle domande presenti nella lista, 
mediante i bottoni delete e edit.

![ ](https://github.com/marcolos/WEBClicker/blob/master/REDMI_img/insert_question.png)

Premendo il pulsante view relativo alla domanda di nostro interesse, essa , con le relative risposte, 
viene impaginata in modo (facendo uso di un proiettore) da poter essere mostrata alla classe. Da qui sarà possibile,
attraverso i bottoni di start e di stop far iniziare e finire il sondaggio, e attraverso il pulsante results 
mostrare i risultati.

![ ](https://github.com/marcolos/WEBClicker/blob/master/REDMI_img/view.png)

Il docente dovrà fornire l’URL che consentirà agli studenti di poter rispondere a tale domanda. L’URL sarà sempre 
la stessa, quindi non sarà necessario fornirla ogni volta.
Gli studenti tramite smartphone o pc potranno a questo punto rispondere alla domanda posta.

![ ](https://github.com/marcolos/WEBClicker/blob/master/REDMI_img/respose.png)

Non appena tutti gli studenti hanno risposto al quesito, il docente può mostrare alla classe i risultati.

![ ](https://github.com/marcolos/WEBClicker/blob/master/REDMI_img/results.png)


