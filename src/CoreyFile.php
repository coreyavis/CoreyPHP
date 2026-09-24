<?php
/* ----------------------------------------------------------------------
 * @package		CoreyPHP
 * @name		CoreyFile
 * @file		CoreyFile.php
 * ---------------------------------------------------------------------*/
declare(strict_types=1);

class CoreyFile extends CoreyPHP {

    /* ----------------------------------------------------------------------
	 * Public Resources - DO NOT EDIT
	 * ----------------------------------------------------------------------*/
	public private(set) ?string $file = null;
	public private(set) int $bytes = 0;
	public private(set) string $size = '';
	public private(set) string $created = '';
	public private(set) string $modified = '';
	public private(set) string $accessed = '';
	public private(set) string $path = '';
	public private(set) string $outputPath = '';
	public private(set) int $files = 0;
	public private(set) int $folders = 0;

    /* ----------------------------------------------------------------------
	 * Private Resources - DO NOT EDIT
	 * ----------------------------------------------------------------------*/

    /* ----------------------------------------------------------------------
	 * Constants / Regular Expressions - DO NOT EDIT
	 * ----------------------------------------------------------------------*/
	protected const BYTEORDERMARK = '/^\xEF\xBB\xBF/';
	protected const DATEFORMAT = 'm/d/Y h:i A';
	protected const FILENAMEREGEX = '/[^a-zA-Z0-9_-]/';
	protected const FILESIZEUNITS = '/^(\d+)\s*([ptgmk]b?)$/i';
	protected const PHPLINKREGEX = '/(href|action)=(["\'])([^"\']*\.php(?:\?[^"\']*)?)\2/i';
	protected const TRAILINGWS = '/[ \t]+$/m';
	protected const URLSLUGIFY = '/[^\w\-]/';
	protected const WINDRIVELTR = '/^[a-zA-Z]:\\\\?$/';
	
	/* ----------------------------------------------------------------------
	 * Core
	 * ----------------------------------------------------------------------*/

    /* ----------------------------------------------------------------------
	 * CoreyFile::__construct()
	 * 
	 * @param array $userConfig - Config options (optional)
	 * ----------------------------------------------------------------------*/
    public function __construct(array $userConfig = []) {
		$defaults = [
			'debug' => false,
			'override' => false
		];
		$this->config = array_merge($defaults, $this->config);
		parent::__construct($userConfig);
		$trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2);
		$file = basename($trace[0]['file']) ?? null;
		if ($file !== null) $this->filename($file);
	}
	
	/* ----------------------------------------------------------------------
	 * Environment
	 * ----------------------------------------------------------------------*/
	
	/* ----------------------------------------------------------------------
	 * CoreyFile::filename()
	 * 
	 * @param string $filename - Name of file
	 * @return $this
	 * ----------------------------------------------------------------------*/
	public function filename(string $filename): static {
    	$filename = trim($filename);
    	if ($filename === '') {
			$this->error('File name cannot be empty!', 'error');
			return $this;
		}
    	if (!empty($this->path)) {
        	$path = rtrim($this->path, '/\\') . '/' . ltrim($filename, '/\\');
    	} else {
        	$path = $filename;
    	}
    	if (!file_exists($path) || is_dir($path)) {
        	$this->error('File does not exist!', 'error');
        	return $this;
    	}
    	$realPath = realpath($path);
    	if ($realPath === false) {
        	$this->error('Unable to resolve file path!', 'error');
        	return $this;
    	}
    	$this->file = pathinfo($realPath, PATHINFO_BASENAME);
    	$this->bytes = filesize($realPath);
    	$this->size = $this->filesizeConvert($this->bytes);
    	$this->created = $this->fileDate(filectime($realPath));
    	$this->modified = $this->fileDate(filemtime($realPath));
    	$this->accessed = $this->fileDate(fileatime($realPath));
    	$this->path = rtrim(str_replace('\\', '/', dirname($realPath)), '/\\') . '/';
    	return $this;
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyFile::getDiagnostics()
	 * 
	 * @return array - System information
	 * ----------------------------------------------------------------------*/
	public function getDiagnostics(): array {
		$tempDir = sys_get_temp_dir();
		$pathValid = is_readable($this->path);
		$path = ($pathValid? $this->path : __DIR__);
		return [
			'environment' => [
				'disk_free_space' => $this->filesizeConvert(disk_free_space($path)),
				'disk_total_space' => $this->filesizeConvert(disk_total_space($path)),
				'operating_system' => PHP_OS,
				'php_version' => PHP_VERSION,
				'temp_directory' => $tempDir,
				'temp_directory_writable' => (bool) is_writable($tempDir)
			],
			'memory' => [
				'limit' => ini_get('memory_limit'),
				'memory_current' => $this->filesizeConvert(memory_get_usage(true)),
				'memory_peak_usage' => $this->filesizeConvert(memory_get_peak_usage(true))
			],
			'php_ini' => [
				'file_uploads' => (bool) ini_get('file_uploads'),
				'max_file_uploads' => (int) ini_get('max_file_uploads'),
				'post_max_size' => ini_get('post_max_size'),
				'upload_max_filesize' => ini_get('upload_max_filesize')
			],
			'timeouts' => [
				'max_execution_time' => ini_get('max_execution_time'),
				'max_input_time' => ini_get('max_input_time')
			]
		];
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyFile::getDirectory()
	 * 
	 * @param string $directory - Directory to retrieve
	 * @param bool $details - Include details
	 * @param bool $perms - Include permissions
	 * @return array|bool - Directory contents as array
	 * ----------------------------------------------------------------------*/
	// TODO: Add blacklist option.
	// TODO: Does it show hidden folders?
	// TODO: Add output option.
	// TODO: Links?
	// TODO: Interpret permissions?
	public function getDirectory(?string $directory = null, bool $details = false, bool $perms = false): array|bool {
		$directory = $directory ?? $this->path;
		$this->files = 0;
		$this->folders = 0;
		$directory = 'file://' . str_replace(array('\\', 'file://'), array('/', ''), trim($directory));
		if (class_exists('DirectoryIterator')) {
            $dir = new DirectoryIterator($directory);
        } else {
			$directory = str_replace('file://', '', $directory);
            if (!is_dir($directory)) {
				$this->error('Directory does not exist or cannot be opened!', 'warning');
				return false;
			}
			$filesList = scandir($directory);
			if ($filesList === false) {
				$this->error('Unable to read directory using fallback method!', 'warning');
				return false;
			}
			$dir = [];
			foreach ($filesList as $filename) {
				$pathname = rtrim($directory, '/') . '/' . $filename;
				$dir[] = new class($filename, $pathname) {
					private string $filename;
					private string $pathname;
					public function __construct(string $filename, string $pathname) {
						$this->filename = $filename;
						$this->pathname = $pathname;
					}
					public function isDot(): bool { return $this->filename === '.' || $this->filename === '..'; }
					public function isLink(): bool { return is_link($this->pathname); }
					public function isDir(): bool { return is_dir($this->pathname); }
					public function getFilename(): string { return $this->filename; }
					public function getPathname(): string { return $this->pathname; }
					public function getCTime(): int|bool { return @filectime($this->pathname); }
					public function getMTime(): int|bool { return @filemtime($this->pathname); }
					public function getATime(): int|bool { return @fileatime($this->pathname); }
					public function getPerms(): int|bool { return @fileperms($this->pathname); }
					public function getExtension(): string { return pathinfo($this->filename, PATHINFO_EXTENSION); }
					public function getSize(): int|bool { return @filesize($this->pathname); }
				};
			}
        }
		$files = array();
        $folders = array();
		foreach ($dir as $file) {
			if ($file->isDot() || $file->isLink()) continue;
			if ($file->isDir()) {
				if ($details) {
					$detail = [
						'folder' => $file->getFilename() . '/',
						'type' => 'folder',
						'path' => rtrim(str_replace(array('\\', 'file://'), array('/', ''), $file->getPathname()), '/\\') . '/',
						'created' => $this->fileDate($file->getCTime()),
						'modified' => $this->fileDate($file->getMTime()),
						'accessed' => $this->fileDate($file->getATime())
					];
					if ($perms) $detail = array_merge($detail, ['perms' => $this->permsConvert($file->getPerms())]);
					$folders[] = $detail;
				} else {
					$folders[] = $file->getFilename() . '/';
				}
				continue;
			}
			if ($details) {
				$detail = [
					'file' => $file->getFilename(),
					'type' => 'file',
					'path' => str_replace(array('\\', 'file://'), array('/', ''), $file->getPathname()),
					'ext' => $file->getExtension(),
					'size' => $this->filesizeConvert($file->getSize()),
					'created' => $this->fileDate($file->getCTime()),
					'modified' => $this->fileDate($file->getMTime()),
					'accessed' => $this->fileDate($file->getATime())
				];
				if ($perms) $detail = array_merge($detail, ['perms' => $this->permsConvert($file->getPerms())]);
				$files[] = $detail;
			} else {
				$files[] = $file->getFilename();
			}
		}
		$this->files = (int) count($files);
		$this->folders = (int) count($folders);
		$dir = array_merge($folders, $files);
		return $dir;
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyFile::getFileMetadata()
	 * 
	 * @return $metadata - The files metadata as array
	 * ----------------------------------------------------------------------*/
	public function getFileMetadata(): array {
		$path_info = pathinfo($this->path . '/' . $this->file);
		$metadata = [
			'filename' => $this->file,
			'bytes' => $this->bytes,
			'size' => $this->size,
			'created' => $this->created,
			'modified' => $this->modified,
			'accessed' => $this->accessed,
			'path' => $this->path,
			'ext' => $path_info['extension']
		];
		return $metadata;
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyFile::getFiles()
	 * 
	 * @param string $directory - Directory to retrieve folders from
	 * @param bool $details - Include details
	 * @param bool $perms - Include permissions
	 * @return array|bool - Directory folders as array
	 * ----------------------------------------------------------------------*/
	public function getFiles(?string $directory = null, bool $details = false, bool $perms = false): array|bool {
		$directory = $directory ?? $this->path;
		$this->files = 0;
		$directory = 'file://' . str_replace(array('\\', 'file://'), array('/', ''), trim($directory));
		if (class_exists('DirectoryIterator')) {
            $dir = new DirectoryIterator($directory);
        } else {
			$directory = str_replace('file://', '', $directory);
            if (!is_dir($directory)) {
				$this->error('Directory does not exist or cannot be opened!', 'warning');
				return false;
			}
			$filesList = scandir($directory);
			if ($filesList === false) {
				$this->error('Unable to read directory using fallback method!', 'warning');
				return false;
			}
			$dir = [];
			foreach ($filesList as $filename) {
				$pathname = rtrim($directory, '/') . '/' . $filename;
				$dir[] = new class($filename, $pathname) {
					private string $filename;
					private string $pathname;
					public function __construct(string $filename, string $pathname) {
						$this->filename = $filename;
						$this->pathname = $pathname;
					}
					public function isDot(): bool { return $this->filename === '.' || $this->filename === '..'; }
					public function isLink(): bool { return is_link($this->pathname); }
					public function isDir(): bool { return is_dir($this->pathname); }
					public function getFilename(): string { return $this->filename; }
					public function getPathname(): string { return $this->pathname; }
					public function getCTime(): int|bool { return @filectime($this->pathname); }
					public function getMTime(): int|bool { return @filemtime($this->pathname); }
					public function getATime(): int|bool { return @fileatime($this->pathname); }
					public function getPerms(): int|bool { return @fileperms($this->pathname); }
					public function getExtension(): string { return pathinfo($this->filename, PATHINFO_EXTENSION); }
					public function getSize(): int|bool { return @filesize($this->pathname); }
				};
			}
        }
		$files = array();
		foreach ($dir as $file) {
			if ($file->isDot() || $file->isLink() || $file->isDir()) continue;
			if ($details) {
				$detail = [
					'file' => $file->getFilename(),
					'path' => str_replace(array('\\', 'file://'), array('/', ''), $file->getPathname()),
					'ext' => $file->getExtension(),
					'size' => $this->filesizeConvert($file->getSize()),
					'created' => $this->fileDate($file->getCTime()),
					'modified' => $this->fileDate($file->getMTime()),
					'accessed' => $this->fileDate($file->getATime())
				];
				if ($perms) $detail = array_merge($detail, ['perms' => $this->permsConvert($file->getPerms())]);
				$files[] = $detail;
			} else {
				$files[] = $file->getFilename();
			}
		}
		$this->files = (int) count($files);
		return $files;
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyFile::getFolders()
	 * 
	 * @param string $directory - Directory to retrieve folders from
	 * @param bool $details - Include details
	 * @param bool $perms - Include permissions
	 * @return array|bool - Directory folders as array
	 * ----------------------------------------------------------------------*/
	public function getFolders(?string $directory = null, bool $details = false, bool $perms = false): array|bool {
		$directory = $directory ?? $this->path;
		$this->folders = 0;
		$directory = 'file://' . str_replace(array('\\', 'file://'), array('/', ''), trim($directory));
		if (class_exists('DirectoryIterator')) {
            $dir = new DirectoryIterator($directory);
        } else {
			$directory = str_replace('file://', '', $directory);
            if (!is_dir($directory)) {
				$this->error('Directory does not exist or cannot be opened!', 'warning');
				return false;
			}
			$filesList = scandir($directory);
			if ($filesList === false) {
				$this->error('Unable to read directory using fallback method!', 'warning');
				return false;
			}
			$dir = [];
			foreach ($filesList as $filename) {
				$pathname = rtrim($directory, '/') . '/' . $filename;
				$dir[] = new class($filename, $pathname) {
					private string $filename;
					private string $pathname;
					public function __construct(string $filename, string $pathname) {
						$this->filename = $filename;
						$this->pathname = $pathname;
					}
					public function isDot(): bool { return $this->filename === '.' || $this->filename === '..'; }
					public function isLink(): bool { return is_link($this->pathname); }
					public function isFile(): bool { return is_file($this->pathname); }
					public function getFilename(): string { return $this->filename; }
					public function getPathname(): string { return $this->pathname; }
					public function getCTime(): int|bool { return @filectime($this->pathname); }
					public function getMTime(): int|bool { return @filemtime($this->pathname); }
					public function getATime(): int|bool { return @fileatime($this->pathname); }
					public function getPerms(): int|bool { return @fileperms($this->pathname); }
				};
			}
        }
        $folders = array();
		foreach ($dir as $file) {
			if ($file->isDot() || $file->isLink() || $file->isFile()) continue;
			if ($details) {
				$detail = [
					'folder' => $file->getFilename(),
					'path' => rtrim(str_replace(array('\\', 'file://'), array('/', ''), $file->getPathname()), '/\\') . '/',
					'created' => $this->fileDate($file->getCTime()),
					'modified' => $this->fileDate($file->getMTime()),
					'accessed' => $this->fileDate($file->getATime())
				];
				if ($perms) $detail = array_merge($detail, ['perms' => $this->permsConvert($file->getPerms())]);
				$folders[] = $detail;
			} else {
				$folders[] = $file->getFilename();
			}
		}
		$this->folders = (int) count($folders);
		return $folders;
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyFile::getParents()
	 * 
	 * @param string $path - Path to get parents from
	 * @param bool $base - Base folder names only
	 * @return array $parents - List of parent directories
	 * ----------------------------------------------------------------------*/
	public function getParents(?string $path = null, bool $base = false): array {
		$parents = [];
		$path = (($path !== null) && ($path !== ''))? $path : $this->path;
		$path = realpath($path) ?: $path;
		if (empty($path)) return [];
		while (true) {
			$currentParent = dirname($path);
			if (($currentParent === $path) || ($currentParent === '.') || ($currentParent === '/') || ($currentParent === '\\')) break;
			if ($base) {
				if (preg_match(self::WINDRIVELTR, $currentParent)) {
					$path = $currentParent;
					break;
				}
				$parents[] = basename($currentParent);
			} else {
				$parents[] = str_replace('\\', '/', rtrim($currentParent, '/\\')) . '/';
			}
			$path = $currentParent;
		}
		if (!empty($path)) {
			$rootPath = str_replace('\\', '/', rtrim($path, '/\\')) . '/';
			if ($base) {
				$parents[] = $rootPath;
			} else {
				if (empty($parents) || (end($parents) !== $rootPath)) {
					$parents[] = $rootPath;
				}
			}
		}
		return $parents;
	}
	
	// TODO: getWebDirectory?
	// TODO: paginate
	
	/* ----------------------------------------------------------------------
	 * CoreyFile::setOutputPath()
	 * 
	 * @param string $path - New output path to set
	 * @return bool - Set output path successfully
	 * ----------------------------------------------------------------------*/
	public function setOutputPath(string $path): bool {
		$resolvedPath = realpath($path);
		$inputPartial = str_replace(array('\\', 'file://'), array('/', ''), $path);
		$inputPartialClean = rtrim($inputPartial, '/\\') . '/';
		$inputBasename = basename($inputPartialClean);
		if ($resolvedPath === false) {
			$allParents = $this->getParents();
			if (is_array($allParents)) {
				foreach ($allParents as $parentPath) {
					if (str_ends_with($parentPath, $inputPartialClean)) {
						$resolvedPath = realpath($parentPath);
						break;
					}
				}
			}
		}
		if ($resolvedPath === false) {
			$childFolders = $this->getFolders(null, true);
			if (is_array($childFolders)) {
				foreach ($childFolders as $folderDetail) {
					if ($folderDetail['folder'] === $inputBasename) {
						$resolvedPath = realpath($folderDetail['path']);
						break;
					}
				}
			}
		}
		if ($resolvedPath === false) {
			$this->error('Invalid output path! Directory does not exist.', 'warning');
			return false;
		}
		$resolvedPath = rtrim(str_replace(array('\\', 'file://'), array('/', ''), $resolvedPath), '/\\') . '/';
		$this->outputPath = $resolvedPath;
		return true;
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyFile::setPath()
	 * 
	 * @param string $path - New path to set
	 * @return bool - Set path successfully
	 * ----------------------------------------------------------------------*/
	public function setPath(string $path): bool {
		$resolvedPath = realpath($path);
		$inputPartial = str_replace(array('\\', 'file://'), array('/', ''), $path);
		$inputPartialClean = rtrim($inputPartial, '/\\') . '/';
		$inputBasename = basename($inputPartialClean);
		if ($resolvedPath === false) {
			$allParents = $this->getParents();
			if (is_array($allParents)) {
				foreach ($allParents as $parentPath) {
					if (str_ends_with($parentPath, $inputPartialClean)) {
						$resolvedPath = realpath($parentPath);
						break;
					}
				}
			}
		}
		if ($resolvedPath === false) {
			$childFolders = $this->getFolders(null, true);
			if (is_array($childFolders)) {
				foreach ($childFolders as $folderDetail) {
					if ($folderDetail['folder'] === $inputBasename) {
						$resolvedPath = realpath($folderDetail['path']);
						break;
					}
				}
			}
		}
		if ($resolvedPath === false) {
			$this->error('Invalid path! Directory does not exist.', 'warning');
			return false;
		}
		$resolvedPath = rtrim(str_replace(array('\\', 'file://'), array('/', ''), $resolvedPath), '/\\') . '/';
		$this->path = $resolvedPath;
		$this->file = null;
		$this->bytes = 0;
		$this->size = '';
		$this->created = '';
		$this->modified = '';
		$this->accessed = '';
		$this->files = 0;
		$this->folders = 0;
		return true;
	}
	
	/* ----------------------------------------------------------------------
	 * Structure
	 * ----------------------------------------------------------------------*/
	
	/* ----------------------------------------------------------------------
	 * CoreyFile::addFolder()
	 * 
	 * @param string $folder - Folder to create
	 * @return bool - Folder creation successful
	 * ----------------------------------------------------------------------*/
	// TODO: Add random folder generation
	// TODO: Add folder permissions option
	public function addFolder(string $folder): bool {
		$folder = str_replace('\\', '/', trim($folder));
		$targetPath = rtrim(str_replace('\\', '/', $this->path), '/') . '/' . ltrim($folder, '/') . '/';
		if (is_dir($targetPath)) return true;
		return mkdir($targetPath, 0755, true);
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyFile::copyFile()
	 * 
	 * @param string $filename - The file to copy
	 * @param string $destPath - Destination path
	 * @return bool - File removal successful
	 * ----------------------------------------------------------------------*/
	public function copyFile(string $filename, string $destPath = ''): bool {
		$path = (file_exists($filename)? realpath($filename) : realpath(rtrim($this->path, '/\\') . '/' . $filename));
		$trustedRoot = realpath($this->path);
		if (!$path || !$trustedRoot || !str_starts_with($path, $trustedRoot)) {
			$this->error('File does not exist or access is restricted!', 'error');
			return false;
		}
		if (!is_file($path)) {
			$this->error('Target is a directory, not a file!', 'error');
			return false;
		}
		if (!is_readable($path)) {
			$this->error('Permission Denied: Cannot read source file!', 'error');
			return false;
		}
		$destPath = rtrim(str_replace('\\', '/', trim($destPath)), '/');
		if ($destPath !== '') {
			$isAbsolute = (str_starts_with($destPath, '/') || (strlen($destPath) > 1 && $destPath[1] === ':'));
			if ($isAbsolute) {
				$targetDir = $destPath;
				if (!is_dir($targetDir)) {
					if (!mkdir($targetDir, 0755, true) && !is_dir($targetDir)) {
						$this->error('Failed to create destination directory!', 'error');
						return false;
					}
				}
			} else {
				$targetDir = rtrim($this->path, '/\\') . '/' . trim($destPath, '/\\');
				if (!is_dir($targetDir)) {
					if (!$this->addFolder($destPath)) {
						$this->error('Failed to create destination directory!', 'error');
						return false;
					}
				}
			}
			$targetDir = realpath($targetDir);
		} else {
			$targetDir = $trustedRoot;
		}
		if (!$targetDir || !is_writeable($targetDir)) {
			$this->error('Permission Denied: Target directory is not writable', 'error');
			return false;
		}
		$ext = pathinfo($path, PATHINFO_EXTENSION);
		$ext = ($ext !== ''? '.' . $ext : '');
		$filename = pathinfo($path, PATHINFO_FILENAME);
		$timestamp = date('Y-m-d_Hi');
		$sourceDir = str_replace('\\', '/', dirname($path));
		$normalizedTargetDir = str_replace('\\', '/', $targetDir);
		if (($destPath === '') || ($normalizedTargetDir === $sourceDir)) {
			$baseName = $filename . '_' . $timestamp;
			$destPath = $targetDir . '/' . $baseName . $ext;
			$counter = 1;
			while (file_exists($destPath)) {
				$destPath = $targetDir . '/' . $baseName . '_' . $counter . $ext;
				$counter++;
			}
		} else {
			$destPath = $targetDir . '/' . $filename . $ext;
			if (file_exists($destPath)) {
				$baseName = $filename . '_' . $timestamp;
				$destPath = $targetDir . '/' . $baseName . $ext;
				$counter = 1;
				while (file_exists($destPath)) {
					$destPath = $targetDir . '/' . $baseName . '_' . $counter . $ext;
					$counter++;
				}
			}
		}
		if (!copy($path, $destPath)) {
			$this->error('Failed to copy the file!', 'error');
			return false;
		}
		return true;
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyFile::removeFile()
	 * 
	 * @param string $filename - The file to remove
	 * @return bool - File removal successful
	 * ----------------------------------------------------------------------*/
	public function removeFile(string $filename): bool {
		$path = (file_exists($filename))? realpath($filename) : realpath(rtrim($this->path, '/\\') . '/' . $filename);
		$trustedRoot = realpath($this->path);
		if (!$path || !str_starts_with($path, $trustedRoot)) {
			$this->error('File does not exist or access is restricted!', 'error');
			return false;
		}
		if (!is_file($path)) {
			$this->error('Target is a directory, not a file!', 'error');
			return false;
		}
		if (!is_writable($path)) {
			$this->error('Permission Denied: Cannot delete this file!', 'error');
			return false;
		}
		return unlink($path);
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyFile::removeFolder()
	 * 
	 * @param string $folder - Folder to remove
	 * @return bool - True if removed
	 * ----------------------------------------------------------------------*/
	public function removeFolder(string $folder): bool {
		if (!is_dir($folder)) {
			$folder = rtrim($this->path, '/\\') . '/' . ltrim($folder, '/\\');
		}
		if (is_dir($folder)) {
			if (!$this->isEmpty($folder)) {
				$this->error('Folder has content!', 'warning');
				return false;
			}
			return rmdir($folder);
		}
		return false;
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyFile::renameFile()
	 * 
	 * @param string $filename - The file to rename
	 * @param string $name - The new filename
	 * @return bool - File rename successful
	 * ----------------------------------------------------------------------*/
	public function renameFile(string $filename, string $name): bool {
		$path = (file_exists($filename))? realpath($filename) : realpath(rtrim($this->path, '/\\') . '/' . $filename);
		$trustedRoot = realpath($this->path);
		if (!$path || !$trustedRoot || !str_starts_with($path, $trustedRoot)) {
			$this->error('File does not exist or access is restricted!', 'error');
			return false;
		}
		if (!is_file($path)) {
			$this->error('Target is a directory, not a file!', 'error');
			return false;
		}
		if (!is_writable($path)) {
			$this->error('Permission Denied: Cannot rename this file!', 'error');
			return false;
		}
		$ext = pathinfo($path, PATHINFO_EXTENSION);
		$ext = $ext !== ''? '.' . $ext : '';
		$name = ltrim(basename($name), '.');
		$name = preg_replace(self::FILENAMEREGEX, '_', pathinfo($name, PATHINFO_FILENAME));
		if (($name === '') || ($name === null)) {
			$this->error('New filename must not be blank or contain only invalid characters!', 'error');
			return false;
		}
		$destPath = rtrim($this->path, '/\\') . '/' . $name . $ext;
		if ($path === $destPath) return true;
		if (file_exists($destPath)) {
			$this->error('A file named ' . basename($destPath) . ' already exists!', 'error');
			return false;
		}
		return rename($path, $destPath);
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyFile::renameFolder()
	 * 
	 * @param string $folder - The folder to rename
	 * @param string $newFolder - The new folder name
	 * @return bool - Folder rename successful
	 * ----------------------------------------------------------------------*/
	public function renameFolder(string $folder, string $newFolder): bool {
		if (!is_dir($folder)) $folder = rtrim($this->path, '/\\') . '/' . ltrim($folder, '/\\');
		$newFolder = rtrim($this->path, '/\\') . '/' . ltrim($newFolder, '/\\');
		if (!is_dir($folder)) {
			$this->error('Source folder does not exist!', 'warning');
			return false;
		}
		if (is_dir($newFolder)) {
			$this->error('Target folder already exists!', 'warning');
			return false;
		}
		return rename($folder, $newFolder);
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyFile::writeHtml()
	 * 
	 * @param string $filename - The file name
	 * @param string $code - Optional HTML code
	 * @param bool $overwrite - Overwrite existing file
	 * @return bool - File creation successful
	 * ----------------------------------------------------------------------*/
	// TODO: If $content = null, then add html template.
	public function writeHtml(string $filename, ?string $code = null, bool $overwrite = false): bool {
		$filename = ltrim(basename($filename), '.');
		$filename = preg_replace(self::FILENAMEREGEX, '_', pathinfo($filename, PATHINFO_FILENAME));
		if (($filename === '') || ($filename === null)) $filename = 'file_' . time();
		$baseDir = !empty($this->outputPath)? $this->outputPath : $this->path;
		$path = rtrim($baseDir, '/\\') . '/' . $filename . '.html';
		if (!$overwrite && file_exists($path)) {
			$this->error('The html file "' . $path . '" already exists!', 'warning');
			return false;
		}
		$content = $code ?? "<html>\n</html>";
		$content = preg_replace(self::BYTEORDERMARK, '', $content);
		$content = str_replace("\0", '', $content);
		$content = str_replace(["\r\n", "\r"], "\n", $content);
		$content = function_exists('mb_scrub')? mb_scrub($content, 'UTF-8') : @iconv('UTF-8', 'UTF-8//IGNORE', $content);
		$content = rtrim($content, "\r\n") . PHP_EOL;
		$mode = ($overwrite? 'wb' : 'xb');
		$handle = @fopen($path, $mode);
		if ($handle === false) {
			$this->error('The html file "' . $path . '" could not be created or opened for writing!', 'warning');
			return false;
		}
		$write = fwrite($handle, $content);
		fclose($handle);
		return $write !== false;
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyFile::writeText()
	 * 
	 * @param string $filename - The file name
	 * @param string $text - Optional Text
	 * @param bool $overwrite - Overwrite existing file
	 * @return bool - File creation successful
	 * ----------------------------------------------------------------------*/
	public function writeText(string $filename, string $text = '', bool $overwrite = false): bool {
		$filename = ltrim(basename($filename), '.');
		$filename = preg_replace(self::FILENAMEREGEX, '_', pathinfo($filename, PATHINFO_FILENAME));
		if (($filename === '') || ($filename === null)) $filename = 'file_' . time();
		$baseDir = !empty($this->outputPath)? $this->outputPath : $this->path;
		$path = rtrim($baseDir, '/\\') . '/' . $filename . '.txt';
		if (!$overwrite && file_exists($path)) {
			$this->error('The text file "' . $path . '" already exists!', 'warning');
			return false;
		}
		$text = preg_replace(self::BYTEORDERMARK, '', $text);
		$text = str_replace("\0", '', $text);
		$text = str_replace(["\r\n", "\r"], "\n", $text);
		$text = function_exists('mb_scrub')? mb_scrub($text, 'UTF-8') : @iconv('UTF-8', 'UTF-8//IGNORE', $text);
		$text = preg_replace(self::TRAILINGWS, '', $text);
		$text = rtrim($text, "\r\n") . PHP_EOL;
		$mode = ($overwrite? 'wb' : 'xb');
		$handle = @fopen($path, $mode);
		if ($handle === false) {
			$this->error('The text file "' . $path . '" could not be created or opened for writing!', 'warning');
			return false;
		}
		$write = fwrite($handle, $text);
		fclose($handle);
		return $write !== false;
	}
	
	/* ----------------------------------------------------------------------
	 * Conversion
	 * ----------------------------------------------------------------------*/
	
	/* ----------------------------------------------------------------------
	 * CoreyFile::convertToBytes()
	 * 
	 * @param string $size - File size to convert
	 * @return int - The converted size in bytes
	 * ----------------------------------------------------------------------*/
	public function convertToBytes(string $size): int {
		$size = trim($size);
		if ($size === '-1') return -1;
		if (!preg_match(self::FILESIZEUNITS, $size, $matches)) {
			return (int) $size;
		}
		$value = (int) $matches[1];
		$unit = strtolower($matches[2]);
		return match($unit[0]) {
			'p' 	=> $value * 1024 * 1024 * 1024 * 1024 * 1024,
			't' 	=> $value * 1024 * 1024 * 1024 * 1024,
			'g' 	=> $value * 1024 * 1024 * 1024,
			'm' 	=> $value * 1024 * 1024,
			'k' 	=> $value * 1024,
			default	=> $value
		};
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyFile::filesizeConvert()
	 * 
	 * @param int|float $bytes - Bytes to convert
	 * @return string $bytes - The converted bytes
	 * ----------------------------------------------------------------------*/
	public function filesizeConvert(int|float $bytes = 0): string {
		if ($bytes >= 1125899906842624) {
			$bytes = number_format($bytes / 1125899906842624, 2) . ' PB';
		} elseif ($bytes >= 1099511627776) {
			$bytes = number_format($bytes / 1099511627776, 2) . ' TB';
		} elseif ($bytes >= 1073741824) {
			$bytes = number_format($bytes / 1073741824, 2) . ' GB';
		} elseif ($bytes >= 1048576) {
			$bytes = number_format($bytes / 1048576, 2) . ' MB';
		} elseif ($bytes >= 1024) {
			$bytes = number_format($bytes / 1024, 2) . ' KB';
		} elseif ($bytes > 1) {
			$bytes = $bytes . ' bytes';
		} elseif ($bytes == 1) {
			$bytes = $bytes . ' byte';
		} else {
			$bytes = '0 bytes';
		}
		return $bytes;
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyFile::permsConvert()
	 * 
	 * @param int $perms - File type bitmask permissions to convert
	 * @return string $perms - Permissions in octal
	 * ----------------------------------------------------------------------*/
	public function permsConvert(int $perms = 0): string {
		return substr(sprintf('%o', $perms), -4);
	}
	
	/* ----------------------------------------------------------------------
	 * Date and Time
	 * ----------------------------------------------------------------------*/
	
	/* ----------------------------------------------------------------------
	 * CoreyFile::fileDate()
	 * 
	 * @param int $date - Date timestamp to format
	 * @return string $date - Formatted date
	 * ----------------------------------------------------------------------*/
	public function fileDate(int $date = 0): string {
		if ($date !== 0) return date(self::DATEFORMAT, $date);
		return date(self::DATEFORMAT, time());
	}
	
	/* ----------------------------------------------------------------------
	 * Image Generation
	 * ----------------------------------------------------------------------*/
	
	/* ----------------------------------------------------------------------
	 * CoreyFile::createJpg()
	 * 
	 * @param string $filename - The file name
	 * @param string $colors - Color code string
	 * @param int $width - Image width
	 * @param int $height - Image height
	 * @return string|bool - File path or false
	 * ----------------------------------------------------------------------*/
	public function createJpg(string $filename, ?string $colors = null, int $width = 1, int $height = 1): string|bool {
		$filename = pathinfo(basename($filename), PATHINFO_FILENAME);
		$baseDir = !empty($this->outputPath)? $this->outputPath : $this->path;
		$path = rtrim($baseDir, '/\\') . '/' . $filename . '.jpg';
		if (file_exists($path) && is_file($path)) {
			$this->error('The jpg file "' . $path . '" already exists!', 'warning');
			return false;
		}
		$colors = $colors ?? '';
		$len = strlen($colors);
		if ($len > ($width * $height)) $this->error(sprintf('The color string length (%d) exceeds the image size grid (%dx%d = %d). Extra characters will be truncated.', $len, $width, $height, ($width * $height)), 'notice');
		$image = imagecreatetruecolor($width, $height);
		if (strlen($colors) === 1) {
			$color = $this->codeToRgb($colors);
			$fillColor = imagecolorallocate($image, $color[0], $color[1], $color[2]);
			imagefill($image, 0, 0, $fillColor);
			$rows = [];
		} else {
			$white = imagecolorallocate($image, 255, 255, 255);
			imagefill($image, 0, 0, $white);
			$string = rtrim(chunk_split($colors, $width, "\n"), "\n");
			$rows = ($string !== ''? explode("\n", $string) : []);
		}
		foreach ($rows as $y => $row) {
			if ($y >= $height) break;
			$columns = str_split($row);
			foreach ($columns as $x => $column) {
				if ($x >= $width) break;
				$color = $this->codeToRgb($column);
				$pixel = imagecolorallocate($image, $color[0], $color[1], $color[2]);
				imagesetpixel($image, $x, $y, $pixel);
			}
		}
		if (imagejpeg($image, $path)) {
			imagedestroy($image);
			return $path;
		}
		imagedestroy($image);
		$this->error('Failed to save the image to disk!', 'error');
		return false;
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyFile::createPng()
	 * 
	 * @param string $filename - The file name
	 * @param string $colors - Color code string
	 * @param int $width - Image width
	 * @param int $height - Image height
	 * @return string|bool - File path or false
	 * ----------------------------------------------------------------------*/
	public function createPng(string $filename, ?string $colors = null, int $width = 1, int $height = 1): string|bool {
		$filename = pathinfo(basename($filename), PATHINFO_FILENAME);
		$baseDir = !empty($this->outputPath)? $this->outputPath : $this->path;
		$path = rtrim($baseDir, '/\\') . '/' . $filename . '.png';
		if (file_exists($path) && is_file($path)) {
			$this->error('The png file "' . $path . '" already exists!', 'warning');
			return false;
		}
		$colors = $colors ?? '';
		$len = strlen($colors);
		if ($len > ($width * $height)) $this->error(sprintf('The color string length (%d) exceeds the image size grid (%dx%d = %d). Extra characters will be truncated.', $len, $width, $height, ($width * $height)), 'notice');
		$string = rtrim(chunk_split($colors, $width, "\n"), "\n");
		$rows = ($string !== ''? explode("\n", $string) : []);
		$image = imagecreatetruecolor($width, $height);
		imagealphablending($image, false);
		imagesavealpha($image, true);
		$transparent = imagecolorallocatealpha($image, 0, 0, 0, 127);
		imagefill($image, 0, 0, $transparent);
		foreach ($rows as $y => $row) {
			if ($y >= $height) break;
			$columns = str_split($row);
			foreach ($columns as $x => $column) {
				if ($x >= $width) break;
				if ($column === ' ') continue;
				$color = $this->codeToRgb($column);
				$pixel = imagecolorallocate($image, $color[0], $color[1], $color[2]);
				imagesetpixel($image, $x, $y, $pixel);
			}
		}
		if (imagepng($image, $path)) {
			imagedestroy($image);
			return $path;
		}
		imagedestroy($image);
		$this->error('Failed to save the image to disk!', 'error');
		return false;
	}
	
	/* ----------------------------------------------------------------------
	 * Static Site Generator
	 * ----------------------------------------------------------------------*/
	
	/* ----------------------------------------------------------------------
	 * CoreyFile::startCode()
	 * 
	 * @return bool - Successful start
	 * ----------------------------------------------------------------------*/
	public function startCode(): bool {
		return ob_start();
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyFile::endCode()
	 * 
	 * @return bool - Successful write
	 * ----------------------------------------------------------------------*/
	public function endCode(): bool {
		$content = ob_get_contents();
		$currentScript = pathinfo($this->file, PATHINFO_FILENAME) . '.php';
		if (!empty($_GET)) {
			$requestUrl = $currentScript . '?' . http_build_query($_GET);
			$relativePath = $this->buildStaticPath($requestUrl, 0);
		} else {
			$relativePath = pathinfo($this->file, PATHINFO_FILENAME) . '.html';
		}
		$dirSegments = array_filter(explode('/', trim(dirname($relativePath), '/\\')), function($seg) {
        	return $seg !== '' && $seg !== '.';
    	});
		$depth = count($dirSegments);
		$staticContent = preg_replace_callback(self::PHPLINKREGEX, function ($matches) use ($depth) {
			$attr = $matches[1];
			$quote = $matches[2];
			$rawUrl = $matches[3];
			$transformedLink = $this->buildStaticPath($rawUrl, $depth);
			return "{$attr}={$quote}{$transformedLink}{$quote}";
		}, $content);
		$staticContent = preg_replace(self::BYTEORDERMARK, '', $staticContent);
		$staticContent = str_replace("\0", '', $staticContent);
		$staticContent = str_replace(["\r\n", "\r"], "\n", $staticContent);
		$staticContent = function_exists('mb_scrub')? mb_scrub($staticContent, 'UTF-8') : @iconv('UTF-8', 'UTF-8//IGNORE', $staticContent);
		$staticContent = rtrim($staticContent, "\r\n") . PHP_EOL;
		$baseDir = !empty($this->outputPath)? $this->outputPath : $this->path;
		$targetFilename = pathinfo($relativePath, PATHINFO_FILENAME);
		$targetDir = rtrim($baseDir, '/\\') . '/';
		$fullPath = $targetDir . $targetFilename . '.html';
		$written = false;
		$shouldWrite = true;
		if (file_exists($fullPath)) {
			$existingContent = file_get_contents($fullPath);
			$normalizedDisk = trim(str_replace("\r", '', $existingContent));
			$normalizedMemory = trim(str_replace("\r", '', $staticContent));
			if (md5($normalizedDisk) === md5($normalizedMemory)) $shouldWrite = false;
		}
		if ($shouldWrite) {
			$written = $this->writeHtml($targetFilename, $staticContent, true);
		}
		ob_end_flush();
		return $written;
	}
	
	// TODO: Method to show code, like in Github with line numbers
	// TODO: outputCode
	// TODO: outputFile
	// TODO: saveFile
	// TODO: savePath
	// TODO: script
	
	/* ----------------------------------------------------------------------
	 * Validation
	 * ----------------------------------------------------------------------*/
	
	/* ----------------------------------------------------------------------
	 * CoreyFile::isEmpty()
	 * 
	 * @param string $folder - Folder to check if empty
	 * @return bool - True if empty
	 * ----------------------------------------------------------------------*/
	public function isEmpty(string $folder): bool {
		if (!is_dir($folder)) {
			$folder = rtrim($this->path, '/\\') . '/' . ltrim($folder, '/\\');
		}
		if (!is_dir($folder)) return false;
		$files = scandir($folder);
		if ($files === false) return false;
		return (count($files) <= 2);
	}
	
	/* ----------------------------------------------------------------------
	 * Version Control
	 * ----------------------------------------------------------------------*/
	
	/* ----------------------------------------------------------------------
	 * CoreyFile::nightlyBuild()
	 * 
	 * @param string|int|null $date - Original release date
	 * @return float - Nightly build
	 * ----------------------------------------------------------------------*/
	public function nightlyBuild(string|int|null $date = null): float {
		if ($date === null) return 0;
		$timestamp = (is_int($date)? $date : strtotime($date));
		if ($timestamp === false) return 0;
		$diff = strtotime(date('Y-m-d')) - strtotime(date('Y-m-d', $timestamp));
		return floor((($diff / 60) / 60) / 24);
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyFile::versionByDate()
	 * 
	 * @param string|int|null $date - Original release date
	 * @param int $patch - Patch iteration
	 * @return string - Version string
	 * ----------------------------------------------------------------------*/
	public function versionByDate(string|int|null $date = null, int $patch = 0): string {
		if ($date === null) {
			$timestamp = time();
		} else {
			$timestamp = is_int($date)? $date : strtotime($date);
			if ($timestamp === false) return '0.0.0';
		}
		return date('Y.m.', $timestamp) . $patch;
	}
	
	/* ----------------------------------------------------------------------
	 * CoreyFile::versionByTime()
	 * 
	 * @param string|int|null $time - Original release date
	 * @param bool $nightly - Include nightly build
	 * @return string - Version string
	 * ----------------------------------------------------------------------*/
	public function versionByTime(string|int|null $time = null, bool $nightly = false): string {
		if ($time === null) {
			$timestamp = time();
		} else {
			$timestamp = is_int($time)? $time : strtotime($time);
			if ($timestamp === false) return '0';
		}
		$dayOfYear = (int) date('z', $timestamp) + 1;
		return date('Y.', $timestamp) . $dayOfYear . date('.G', $timestamp) . ($nightly? '-' . $this->nightlyBuild($timestamp) : '');
	}
	
	/* ----------------------------------------------------------------------
	 * Helpers
	 * ----------------------------------------------------------------------*/
	
	/* ----------------------------------------------------------------------
	 * CoreyFile::buildStaticPath()
	 * 
	 * @param string $url - URL of page
	 * @param int $depth - Folder depth
	 * @return bool - Successful write
	 * @access protected
	 * ----------------------------------------------------------------------*/
	protected function buildStaticPath(string $url, int $depth = 0): string {
		$url = htmlspecialchars_decode($url);
		$parts = parse_url($url);
		$path = $parts['path'] ?? $this->file;
		$baseName = pathinfo($path, PATHINFO_FILENAME);
		$fragment = isset($parts['fragment']) ? '#' . $parts['fragment'] : '';
		if (empty($parts['query'])) {
			$target = $baseName . '.html' . $fragment;
			return str_repeat('../', $depth) . $target;
		}
		parse_str($parts['query'], $queryParams);
		$pathSegments = array_values($queryParams);
		$pathSegments = array_map(function($segment) {
			return preg_replace(self::URLSLUGIFY, '_', $segment);
		}, $pathSegments);
		$fileName = array_pop($pathSegments);
		if (strtolower($baseName) !== 'index') {
			array_unshift($pathSegments, $baseName);
		}
		$subDirs = !empty($pathSegments) ? implode('/', $pathSegments) . '/' : '';
		$fullRelativePath = $subDirs . $fileName . '.html' . $fragment;
		return str_repeat('../', $depth) . $fullRelativePath;
	}

}

?>
