<?php /** @noinspection UseStaticReturnTypeInsteadOfSelfInspection */

  /*
  Завдання: необхідно написати клас для пошуку файлів і директорій.
  Клас має реалізовувати інтерфейс FileFinderInterface.
  На виході клас має повертати масив строк - повних шляхів до папок/файлів, які відповідають заданим умовам.
  Нижче в файлі є приклади використання класу.

  Можна використовувати тільки вбудований функціонал PHP.

  Завдання розраховане на 1-2 години роботи, просимо не витрачати більше.
  Краще додайте до реалізації список доробок/покращень, які ви б зробили в коді, якби працювали б над ним далі.
  */

  interface FileFinderInterface
  {

    /**
     * Search in directory $directory.
     * If called multiple times, the result must include paths from all provided directories.
     */
    public function inDir(string $directory) : self;

    /** Filter: only files, ignore directories */
    public function onlyFiles() : self;

    /** Filter: only directories, ignore files */
    public function onlyDirectories() : self;

    /**
     * Filter by regular expression on full path.
     * If called multiple times, the result must include paths that match at least one of the provided expressions.
     */
    public function match(string $regularExpression) : self;


    /**
     * Returns array of all found files/directories (full path)
     * @return string[]
     */
    public function find() : array;

  }


  /** @noinspection PhpHierarchyChecksInspection */
  class FileFinderImplementation implements FileFinderInterface
  {
    private array $directories = [];
    private array $filters = [];
    private bool $onlyFilesStatus;
    private bool $onlyDirectoriesStatus;

    public function inDir(string $directory) : self
    {
      $this->directories[] = $directory;
      return $this;
    }

    public function onlyFiles() : self
    {
      $this->onlyFilesStatus = true;
      $this->onlyDirectoriesStatus = false;
      return $this;
    }

    public function onlyDirectories() : self
    {
      $this->onlyDirectoriesStatus = true;
      $this->onlyFilesStatus = false;
      return $this;
    }

    public function match(string $regularExpression) : self
    {
      $this->filters[] = $regularExpression;
      return $this;
    }

    public function find() : array
    {
      $result = [];
      $this->directoriesCheck();
      foreach($this->directories as $path) {
        foreach (scandir($path) as $line) {
          if (!empty($this->filters)) {
            foreach ($this->filters as $filter) {
              if (preg_match($filter, $line)) {
                $this->search($path, $line, $result);
              }
            }
          } else {
            $this->search($path, $line, $result);
          }
        }
      }
      return $result;
    }

    private function search($path, $line, &$result)
    {
      if ($this->onlyDirectoriesStatus && is_dir($path . '/' . $line) && $line !== "." && $line !== "..") {
        $result[] = $path . '/' . $line;
      } elseif ($this->onlyFilesStatus && !is_dir($path . '/' . $line)) {
        $result[] = $path . '/' . $line;
      } elseif (!$this->onlyFilesStatus && !$this->onlyDirectoriesStatus  && $line !== "." && $line !== "..") { 
        $result[] = $path . '/' . $line;
      }
    }

    private function directoriesCheck()
    {
      if (empty($this->directories)) {
        throw new Exception("No directory is set");
      }
    }
  }

  # Приклади використання FileFinderImplementation:

  # search for all .conf or .ini files in directories /etc/ and /var/log/
  $finder = new FileFinderImplementation();

  # complex search in multiple directories
  $finder
    ->onlyFiles()
    ->inDir('/etc/')
    ->inDir('/var/log/')
    ->match('/.*\.conf$/')
    ->match('/.*\.ini$/');
  foreach ($finder->find() as $file) {
    print $file . "\n";
  }
  print "\n\n";


  # search for all files in /tmp
  $finder = (new FileFinderImplementation())
    ->onlyFiles()
    ->inDir('/tmp');
  foreach ($finder->find() as $file) {
    print $file . "\n";
  }
  print "\n\n";


  # search for .doc files in /tmp
  $finder = (new FileFinderImplementation())
    ->match('/.*\.doc$/')
    ->onlyFiles()
    ->inDir('/tmp');
  foreach ($finder->find() as $file) {
    print $file . "\n";
  }
  print "\n\n";


  # list all directories in /var
  $finder = (new FileFinderImplementation())
    ->onlyDirectories()
    ->inDir('/var/log/');
  foreach ($finder->find() as $file) {
    print $file . "\n";
  }
  print "\n\n";


  # should throw an exception if no directories were provided
  try {
    $files = (new FileFinderImplementation())
      ->onlyFiles()
      ->match('/.*\.ini$/')
      ->find(); # -> exception
    print "When no dir were provided: exception was not thrown, something does not work correctly\n";
  } catch (\Exception $exception) {
    print "When no dir were provided: exception was thrown with message \"" . $exception->getMessage() . "\"\n";
  }
