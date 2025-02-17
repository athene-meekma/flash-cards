# Flash Cards
This project allows you to create flash card packs for studying

## Getting started
1. Clone the repo
   ```
   git clone https://github.com/athene-meekma/flash-cards.git
   ```
2. Copy .env.example to .env and set your variables
   ```
   cp .env.example .env
   ```
3. Generate certificates
   ```sh
   brew install mkcert
   brew install nss # if you use Firefox
   mkdir ssl
   mkcert -key-file ssl/localhost-key.pem -cert-file ssl/localhost.pem localhost
   # Optional:
   mkcert -key-file ssl/key.pem -cert-file ssl/cert.pem flash-cards.dev
   ```
4. (Optional) Add flash-cards.dev to `/etc/hosts`
   ```
   127.0.0.1       localhost flash-cards.dev
   ```
5. Start the docker containers
   ```
   docker compose up --build -d
   ```
6. Go to https://localhost or https://flash-cards.dev if you've completed the optional steps
