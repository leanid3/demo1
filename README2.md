
# Описание БД

## Таблицы

### Users Table
- `id` - Primary key
- `name` - String (User's full name)
- `login` - String (Unique)
- `phone` - String (Unique)
- `role` - String (Default: 'user')
- `email` - String (Unique)
- `status` - String (Default: 'active')
- `email_verified_at` - Timestamp (Nullable)
- `password` - String
- `remember_token` - String
- `created_at` - Timestamp
- `updated_at` - Timestamp

### Cards Table
- `id` - Primary key
- `author` - String
- `title` - String
- `type` - String
- `status` - String (Default: 'pending')
- `rejection_reason` - String (Nullable)
- `user_id` - Foreign key (References users.id)
- `created_at` - Timestamp
- `updated_at` - Timestamp
- `deleted_at` - Timestamp (Soft deletes)

### Courses Table
- `id` - Primary key
- `title` - String
- `description` - Text
- `price` - Decimal (8,2)
- `status` - String
- `created_at` - Timestamp
- `updated_at` - Timestamp

### Orders Table
- `id` - Primary key
- `user_id` - Foreign key (References users.id)
- `course_id` - Foreign key (References courses.id)
- `status` - String (Default: 'pending')
- `date_recording` - Date
- `payment_method` - Enum ('card', 'cash') (Default: 'cash')
- `created_at` - Timestamp
- `updated_at` - Timestamp

### Comments Table
- `id` - Primary key
- `user_id` - Foreign key (References users.id)
- `course_id` - Foreign key (References courses.id)
- `comment` - Text
- `order_id` - Foreign key (References orders.id)
- `status` - String (Default: 'published')
- `created_at` - Timestamp
- `updated_at` - Timestamp

## Relationships

### One-to-Many Relationships
- User has many Cards (user_id in cards table)
- User has many Orders (user_id in orders table)
- User has many Comments (user_id in comments table)
- Course has many Orders (course_id in orders table)
- Course has many Comments (course_id in comments table)
- Order has many Comments (order_id in comments table)

### Many-to-One Relationships
- Card belongs to User (user_id in cards table)
- Order belongs to User (user_id in orders table)
- Order belongs to Course (course_id in orders table)
- Comment belongs to User (user_id in comments table)
- Comment belongs to Course (course_id in comments table)
- Comment belongs to Order (order_id in comments table)

## Additional Tables

### Password Reset Tokens
- `email` - Primary key
- `token` - String
- `created_at` - Timestamp (Nullable)

### Sessions
- `id` - Primary key
- `user_id` - Foreign key (Nullable, References users.id)
- `ip_address` - String (45)
- `user_agent` - Text
- `payload` - LongText
- `last_activity` - Integer

### Jobs
- `id` - Primary key
- `queue` - String (Indexed)
- `payload` - LongText
- `attempts` - Unsigned TinyInteger
- `reserved_at` - Unsigned Integer (Nullable)
- `available_at` - Unsigned Integer
- `created_at` - Unsigned Integer

### Job Batches
- `id` - Primary key
- `name` - String
- `total_jobs` - Integer
- `pending_jobs` - Integer
- `failed_jobs` - Integer
- `failed_job_ids` - LongText
- `options` - MediumText (Nullable)
- `cancelled_at` - Integer (Nullable)
- `created_at` - Integer
- `finished_at` - Integer (Nullable)

### Failed Jobs
- `id` - Primary key
- `uuid` - String (Unique)
- `connection` - Text
- `queue` - Text
- `payload` - LongText
- `exception` - LongText
- `failed_at` - Timestamp

# Фабрики

Для ускорения разработки созданы фабрики по оснвоным таблицам

# Даные пользователей:
- User, admin
- остальные пользователи сгенерированы с использованием faker