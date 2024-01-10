#!/usr/bin/env bash
set -e
set -x

export DEBIAN_FRONTEND=noninteractive

apt-get update
apt-get install -y -q wget software-properties-common apt-transport-https libfcgi0ldbl gnupg2

wget -qO - https://packages.sury.org/php/apt.gpg | apt-key add -

# TODO mirror na suryho?
cat > /etc/apt/sources.list.d/php.list <<EOF
deb https://packages.sury.org/php/ bullseye main
EOF

apt-get update

apt-get install -y --force-yes php8.1-cli php8.1-fpm php8.1-readline php8.1-xml php8.1-curl php8.1-gd php8.1-bcmath php8.1-mysql php8.1-mbstring php8.1-soap php8.1-zip php8.1-maxminddb php8.1-memcache php8.1-redis php8.1-memcached php8.1-sqlite3 php8.1-intl php8.1-uuid php8.1-imap php8.1-yaml php8.1-ldap php8.1-imagick php8.1-xdebug libssl1.1

apt-get purge -y -q wget software-properties-common
apt-get clean -y
rm -rf /var/lib/apt/lists/*
