## Game Of Life

Simple Game of life simulation

## Requirements

- docker
- docker-compose

## DETAILS

Docker and Docker compose is unnecessary for this project, but because I don't have PHP and Nginx Installed
On my local machine I used docker.

I used factory design pattern for creating pattern, also by using Enum and abstraction we can sure that we have instance
from pattern object and decouple objects, I tried to separate concerns as much as I can.
Therefore, I separated patterns, printer and the game from eachother.

Also I added custom exception to validate user input for pattern for better error handling.

We have Template directory, so we can have another pattern in the future if needed.

## Installation

1. get the repo
    ````bash
    git pull git@github.com:saeidtaheri/game-life.git
   ````
2. Change directory.
    ````bash
    cd game-life
   ````
3. Start docker.
    ````bash
    docker-compose up -d
    ````
4. Enter to the container.
   ````bash
    docker compose exec -uca php bash
    ````
5. Play The game.
    ````bash
    php public/index.php glider
   ````

6. By default, the game playing for just 60 seconds, if you need more time you can manually add the time in seconds like
   this:
    ````bash
    php public/index.php glider 100
   ````