FROM php:7.4-cli AS base

WORKDIR /app

COPY composer.json /app

###

FROM base AS build

RUN apt update -yqq \
  && apt install -yqq \
    git \
    unzip \
  && apt autoremove -yqq

COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN composer install
