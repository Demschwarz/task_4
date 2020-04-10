<?php
/**
 * Реализовать проверку заполнения обязательных полей формы в предыдущей
 * с использованием Cookies, а также заполнение формы по умолчанию ранее
 * введенными значениями.
 */

// Отправляем браузеру правильную кодировку,
// файл index.php должен быть в кодировке UTF-8 без BOM.
header('Content-Type: text/html; charset=UTF-8');

$abilities = ['god' => 'бессмертие', 'fly' => 'левитация', 'idclip' => 'магия', 'fireball' => 'огонь'];
// В суперглобальном массиве $_SERVER PHP сохраняет некторые заголовки запроса HTTP
// и другие сведения о клиненте и сервере, например метод текущего запроса $_SERVER['REQUEST_METHOD'].
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  // Массив для временного хранения сообщений пользователю.
  $messages = array();

  // В суперглобальном массиве $_COOKIE PHP хранит все имена и значения куки текущего запроса.
  // Выдаем сообщение об успешном сохранении.
  if (!empty($_COOKIE['save'])) {
    // Удаляем куку, указывая время устаревания в прошлом.
    setcookie('save', '', 100000);
    // Если есть параметр save, то выводим сообщение пользователю.
    $messages[] = 'Спасибо, ваши данные сохранены!';
  }

  // Складываем признак ошибок в массив.

  // ДЕЛЕГИРОВАНИЕ ОШИИБОК
  $errors = array();
  $errors['fio'] = !empty($_COOKIE['fio_error']);
  $errors['email'] = !empty($_COOKIE['email_error']);
  $errors['year'] = !empty($_COOKIE['year_error']);
  $errors['sex'] = !empty($_COOKIE['sex_error']);
  $errors['lungs'] = !empty($_COOKIE['lungs_error']);
  $errors['abilities'] = !empty($_COOKIE['abilities_error']);
  $errors['bio'] = !empty($_COOKIE['bio_error']);
  $errors['check'] = !empty($_COOKIE['check_error']);
  // TODO: аналогично все поля.

  // Выдаем сообщения об ошибках.
  if ($errors['fio']) {
    // Удаляем куку, указывая время устаревания в прошлом.
    setcookie('fio_error', '', 100000);
    // Выводим сообщение.
    if ($_COOKIE['fio_error'] == "1") {
      $messages[] = '<div id="error">Пожалуйста, впишите имя.</div>';
    }
    else {
        $messages[] = '<div id="error">Пожалуйста, впишите имя русскими буквами.</div>';
    }
    
  }
  if ($errors['email']) {
      // Удаляем куку, указывая время устаревания в прошлом.
      setcookie('email_error', '', 100000);
      // Выводим сообщение.
      if ($_COOKIE['email_error'] == "1") {
          $messages[] = '<div id="error">Пожалуйста, заполните поле Email.</div>';
      }
      else {
          $messages[] = '<div id="error">Воспользуйтесь шаблоном email: name@mail.domain</div>';
      }
  }
  if ($errors['year']) {
      // Удаляем куку, указывая время устаревания в прошлом.
      setcookie('year_error', '', 100000);
      // Выводим сообщение.
      if ($_COOKIE['year_error'] == "1") {
          $messages[] = '<div id="error">Пожалуйста, выберете год рождения</div>';
      }
  }
  if ($errors['sex']) {
      // Удаляем куку, указывая время устаревания в прошлом.
      setcookie('sex_error', '', 100000);
      // Выводим сообщение.
      if ($_COOKIE['sex_error'] == "1") {
          $messages[] = '<div id="error">Пожалйста, укажите Ваш пол.</div>';
      }
  }
  if ($errors['lungs']) {
      // Удаляем куку, указывая время устаревания в прошлом.
      setcookie('lungs_error', '', 100000);
      // Выводим сообщение.
      if ($_COOKIE['lungs_error'] == "1") {
          $messages[] = '<div id="error">Выберете количество конечностей.</div>';
      }
  }
  
  
  if ($errors['abilities']) {
      // Удаляем куку, указывая время устаревания в прошлом.
      setcookie('abilities_error', '', 100000);
      // Выводим сообщение.
      if ($_COOKIE['abilities_error'] == "1") {
          $messages[] = '<div id="error">Заполните способности!.</div>';
      }
      else {
          $messages[] = '<div id="error">Только наши способности.</div>';
      }
  }
  
  
  if ($errors['bio']) {
      // Удаляем куку, указывая время устаревания в прошлом.
      setcookie('bio_error', '', 100000);
      // Выводим сообщение.
      if ($_COOKIE['bio_error'] == "1") {
          $messages[] = '<div id="error">Пожалуйста, напишите биографию.</div>';
      }
      else {
          $messages[] = '<div id="error">Слишком большой текст в Биографии, максимум - 158 символов.</div>';
      }
  }
  if ($errors['check']) {
      // Удаляем куку, указывая время устаревания в прошлом.
      setcookie('check_error', '', 100000);
      // Выводим сообщение.
      if ($_COOKIE['check_error'] == "1") {
          $messages[] = '<div id="error">Примите правила, они обязательно.</div>';
      }
  }
  // TODO: тут выдать сообщения об ошибках в других полях.

  // Складываем предыдущие значения полей в массив, если есть.


  // все зничения - в массив
  $values = array();
  $values['fio'] = empty($_COOKIE['fio_value']) ? '' : $_COOKIE['fio_value'];
  $values['email'] = empty($_COOKIE['email_value']) ? '' : $_COOKIE['email_value'];
  $values['year'] = empty($_COOKIE['year_value']) ? '' : $_COOKIE['year_value'];
  $values['sex'] = empty($_COOKIE['sex_value']) ? '' : $_COOKIE['sex_value'];
  $values['lungs'] = empty($_COOKIE['lungs_value']) ? '' : $_COOKIE['lungs_value'];
  if (!empty($_COOKIE['abilities_value'])) {
      $abilities_value = unserialize($_COOKIE['abilities_value']);
  }
  $values['abilities'] = [];
  if (isset($abilities_value) && is_array($abilities_value)) {
      foreach ($abilities_value as $ability) {
          if (!empty($abilities[$ability])) {
              $values['abilities'][$ability] = $ability;
          }
      }
  }
  
  $values['bio'] = empty($_COOKIE['bio_value']) ? '' : $_COOKIE['bio_value'];
  $values['check'] = empty($_COOKIE['check_value']) ? '' : $_COOKIE['check_value'];
  // TODO: аналогично все поля.

  // Включаем содержимое файла form.php.
  // В нем будут доступны переменные $messages, $errors и $values для вывода 
  // сообщений, полей с ранее заполненными данными и признаками ошибок.
  include('form.php'); // перенаправление в форму
  // ДЕЙСТВИЕ МЕТОДА GET ЗДЕСЬ КОНЧАЕТСЯ
}
// Иначе, если запрос был методом POST, т.е. нужно проверить данные и сохранить их в XML-файл.
// НАЧАЛО РАБОТЫ МЕТОДА POST
else {
    // ПРОВЕРКА НЕПРАВИЛЬНО ВВЕДЁННЫХ ДАННЫХ
  $errors = FALSE;
  if (empty($_POST['fio'])) {
    // Выдаем куку на день с флажком об ошибке в поле fio.
    // на сутки
    //setcookie('fio_error', '1', time() + 24 * 60 * 60);
    // до конца сессии
      setcookie('fio_error', '1', 0);
      setcookie('fio_value', '', 0);
    $errors = TRUE;
  }
  else {
      if (!preg_match('/^[а-яА-Я]+$/u', $_POST['fio'])) {
          setcookie('fio_error', '2', 0);
          $errors = TRUE;
      }
    // Сохраняем ранее введенное в форму значение на год.
    setcookie('fio_value', $_POST['fio'], time() + 365 * 24 * 60 * 60);
  }
  
  
  if (empty($_POST['email'])) {
      // Выдаем куку на день с флажком об ошибке в поле fio.
      setcookie('email_error', '1', 0);
      setcookie('email_value', '', 0);
      $errors = TRUE;
  }
  else {
      if (!preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/u', $_POST['email'])) {
          setcookie('email_error', '2', 0);
          $errors = TRUE;
      }
      // Сохраняем ранее введенное в форму значение на год.
      setcookie('email_value', $_POST['email'], time() + 365 * 24 * 60 * 60);
  }
  
  if (empty($_POST['year'])) {
      setcookie('year_error', '1', 0);
      $errors = TRUE;
  }
  else {
      setcookie('year_value', (int)$_POST['year'], time() + 365 * 24 * 60 * 60);
  }
  
  
  if (empty($_POST['sex'])) {
      setcookie('sex_error', '1', 0);
      $errors = TRUE;
  }
  else {
      setcookie('sex_value', $_POST['sex'], time() + 365 * 24 * 60 * 60);
  }
  
  
  if (empty($_POST['lungs'])) {
      setcookie('lungs_error', '1', 0);
      setcookie('lungs_value', '', 0);
      $errors = TRUE;
  }
  else {
      setcookie('lungs_value', $_POST['lungs'], time() + 365 * 24 * 60 * 60);
  }
  
  
  if (empty($_POST['abilities'])) {
      // Выдаем куку на день с флажком об ошибке в поле
      // до конца сессии
      setcookie('abilities_error', '1', 0);
      $errors = TRUE;
  }
  else {
      $abilities_error = FALSE;
      foreach($_POST['abilities'] as $a) {
          if (empty($abilities[$a])) {
              setcookie('abilities_error', '2', 0);
              $errors = TRUE;
              $abilities_error = TRUE;
          }
      }
      if (!$abilities_error) {
      // Сохраняем ранее введенное в форму значение на год.
        setcookie('abilities_value', serialize($_POST['abilities']), time() + 365 * 24 * 60 * 60);
      }
  }
  
  
  if (empty($_POST['bio'])) {
      setcookie('bio_error', '1', 0);
      setcookie('bio_value', '', 0);
      $errors = TRUE;
  }
  else {
      if (strlen($_POST['bio'])>158){
          setcookie('bio_error', '2', 0);
          $errors = TRUE;
      }
      setcookie('bio_value', $_POST['bio'], time() + 365 * 24 * 60 * 60);
  }
  if (empty($_POST['check'])) {
      setcookie('check_error', '1', 0);
      setcookie('check_value', '', 0);
      $errors = TRUE;
  }
  else {
      setcookie('chek_value', $_POST['check'], time() + 365 * 24 * 60 * 60);
  }

  if ($errors) {
    // При наличии ошибок перезагружаем страницу и завершаем работу скрипта.
    header('Location: index.php');
    exit();
  }
  else {
      // УДАЛЕНИЕ КУКИС - ПРЕДУРПЕЖДЕНИЙ ОБ ОШИБКАХ
    setcookie('fio_error', '', 100000);
    setcookie('email_error', '', 100000);
    setcookie('year_error', '', 100000);
    setcookie('sex_error', '', 100000);
    setcookie('lungs_error', '', 100000);
    setcookie('abilities_error', '', 100000);
    setcookie('bio_error', '', 100000);
    setcookie('check_error', '', 100000);
    // TODO: тут необходимо удалить остальные Cookies.
  }

  
  $user = 'u20419';
  $pass = '9620609';
  $db = new PDO('mysql:host=localhost;dbname=u20419', $user, $pass, array(PDO::ATTR_PERSISTENT => true));
  
  //Еще вариант
   $stmt = $db->prepare("INSERT INTO application (name, email, birth, sex, numlimbs, abilities, biography) VALUES (:firstname, :nemail, :year, :valsex, :numlimbs, :abil, :biog)");
   $stmt->bindParam(':numlimbs', $numlimbs);
   $stmt->bindParam(':abil', $abil);
   $stmt->bindParam(':biog', $biog);
   $stmt->bindParam(':year', $year);
   $stmt->bindParam(':valsex', $valsex);
   $stmt->bindParam(':firstname', $firstname);
   $stmt->bindParam(':nemail', $nemail);

   $numlimbs = (int)$_POST['lungs'];
   $abil = serialize($_POST['abilities']);
   $biog = $_POST['bio'];
   $year = (int)$_POST['year'];
   $valsex = $_POST['sex'];
   $firstname = $_POST['fio'];
   $nemail = $_POST['email'];
   $stmt->execute();
  // МЕТОД POST ОТРАБОТАЛ
  

  // Сохраняем куку с признаком успешного сохранения.
  setcookie('save', '1');

  // Делаем перенаправление.
  header('Location: index.php');
}

