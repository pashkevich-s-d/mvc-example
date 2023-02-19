# mvc-example

This is `not perfect` example, but still it can be used to show MVC approach in PHP applications. Can be useful for trainees.

# Setup instructions

1. Download/Clone current project.
2. Copy `.env.example` file to `.env` in root folder of application.
3. Run `composer install`
4. Setup all required parameters in `.env`.
```
DATABASE_HOST="localhost"
DATABASE_NAME="database"
DATABASE_USER="user"
DATABASE_PASSWORD="password"
DATABASE_PORT=3306
```
5. If you need example database, you can use this `init.sql` - https://github.com/pashkevich-s-d/trainee-program/blob/master/Examples/PDO/init.sql


# Details

User and Message related models, controllers and views added just for an example (including initialization of database). So you can remove those and define your own domain entities and routes (`config/routes.php`).

# Project structure

```
config
-- parameters.php // can be used to store app parameters
-- routes.php // can be used to define routes
public
-- index.php // front controller
src
-- Component // here you can define app components
---- Database.php // setup database connection
---- Router.php // looks for required controller
---- View.php // allows to build page
-- Controller // here you can define controllers
-- Exception // here you can define your custom exceptions
-- Model // here you can define your models (+ database operations)
views
-- pages // here you can define app pages
-- templates // here you can define app templates
.env // here you can define ENV specific parameters, such as DATABASE connection
```

# Example

You would like to crelate `http://your-domain.loc/users/list` page.

1. Create new route in `config/routes.php`:

```
'users\/list' => 'users/list',
```

```
Note:

Routes can be defined using regex, example:
'users\/([0-9]+)' => 'users/view/$1',

With such route it will be possible to define such controller:

class UsersController
{
    public function actionView(string $userId)
    {
        echo "Hello from user (ID: $userId) view page!";
    }
}

```

2. Create new model to be able to fetch users data from database (`src/Model/User.php`)

```
class User
{
    public int $id;
    public string $name;
    public string $surname;

    public static function getAll(): array
    {
        $db = Database::getConnection();

        $stmt = $db->query('SELECT * FROM users');
        $stmt->setFetchMode(PDO::FETCH_CLASS, User::class);

        return $stmt->fetchAll();
    }
}
```

3. Create page to display users (`views/pages/users-list.php`):

```
<h1>Users: </h1>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Surname</th>
        </tr> 
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <th><?= $user->getId(); ?></th>
                <th><?= $user->getName(); ?></th>
                <th><?= $user->getSurname(); ?></th>
            </tr> 
        <?php endforeach; ?>
    </tbody>
</table>
```

4. Create new controller (`src/Controller/UsersController.php`):

```
class UsersController
{
    public function actionList()
    {
        $users = User::getAll();

        View::build(
            'main',
            'users-list',
            [
                'users' => $users,
            ]
        );
    }
}
```

5. Open `http://your-domain.loc/users/list`
