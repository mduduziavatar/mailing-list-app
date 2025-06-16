# Mailing List App

## Setup Instructions

1. Clone the repository:

   ```
   git clone <repo-url>
   cd mailing-list-app
   ```

2. Install dependencies:

   ```
   composer install
   npm install
   npm run dev
   ```

3. Copy `.env.example` to `.env` and configure your database and other settings.

4. Generate application key:

   ```
   php artisan key:generate
   ```

5. Run migrations and seeders:

   ```
   php artisan migrate:fresh --seed
   ```

6. Serve the application:

   ```
   php artisan serve
   ```

## Database and Models

- The app manages Contacts, Contact Lists, and Campaigns.
- Campaigns belong to a Contact List (`contact_list_id`).
- Campaigns have the following important fields:
  - `subject` (string)
  - `message` (text)
  - `start_date` (date)
  - `end_date` (date)
  - `contact_list_id` (foreign key)

## Important Notes

- Make sure `start_date` and `end_date` are included in the `fillable` array in `app/Models/Campaign.php`.
- The CampaignSeeder seeds campaigns with random start and end dates.
- The edit campaign form supports editing the start and end dates.
- The campaign listing page displays the subject, associated list, and start/end dates.

## Usage

- Use the UI to create, edit, and delete campaigns.
- Export campaigns via the export button on the campaigns listing page.

## Troubleshooting

- If you encounter errors with missing factory methods, ensure your models use the `HasFactory` trait.
- Run `composer dump-autoload` if classes aren't recognized.
- Clear caches with:
  ```
  php artisan config:clear
  php artisan cache:clear
  php artisan view:clear
  ```

## License

Specify your license here.