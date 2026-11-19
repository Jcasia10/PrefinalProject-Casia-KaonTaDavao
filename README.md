# Kaon Ta! Davao – Casia's Food Guide

**Julianne Marie Casia**

## Setup

```bash
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate:fresh --seed
npm install
npm run build
php artisan serve
```

The app is public and does not use authentication. Reviewers are selected from seeded users.

## Personalized seed data

- Districts: Poblacion, Talomo, Agdao, Buhangin, Toril, Calinan
- Features: Suki ni Casia, Budget Meal, Halal, Open 24 Hours, Aircon, Family Friendly
- Users: Julianne Marie Casia (`casia@kaonta.test`) and Tita Casia (`tita.casia@kaonta.test`)
- Eatery: Carinderia ni Casia in Poblacion
- Permit: `DVO-2026-1013`, expiring October 13, 2027
- Password for the two named users: `kaonta2026`

## Relationships

| Relationship | Type | Why it fits |
|---|---|---|
| District → Eatery | hasMany / belongsTo | A district contains many eateries and each eatery belongs to one district. |
| Eatery → Dish | hasMany / belongsTo | An eatery serves many dishes, while each dish has one owner eatery. |
| Eatery → Review | hasMany / belongsTo | Residents can write several reviews and each review describes one eatery. |
| User → Review | hasMany / belongsTo | A reviewer may write many reviews and each review has one reviewer. |
| Eatery ↔ Feature | belongsToMany | Features such as Halal can apply to many eateries and vice versa. |
| Eatery → Permit | hasOne / belongsTo | Each eatery has one business permit. |
| District → Review | hasManyThrough | District review counts pass through the district's eateries. |

## Routes

```text
GET|HEAD        /                            home
GET|HEAD        districts                   districts.index
GET|HEAD        districts/{district}        districts.show
GET|HEAD        eateries                    eateries.index
POST            eateries                    eateries.store
GET|HEAD        eateries/create             eateries.create
GET|HEAD        eateries/{eatery}           eateries.show
PUT|PATCH       eateries/{eatery}           eateries.update
DELETE          eateries/{eatery}           eateries.destroy
GET|HEAD        eateries/{eatery}/edit      eateries.edit
POST            eateries/{eatery}/reviews   eateries.reviews.store
GET|HEAD        reviewers/{user}            reviewers.show
DELETE          reviews/{review}            reviews.destroy
```

Screenshots are available in `screenshots/`:

- `eatery-list.svg`
- `eatery-page.svg`
- `create-validation.svg`
