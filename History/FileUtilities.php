<?php
namespace RqData\History;

class FileUtilities {
	public static function getUrlHistoryRootFolderPath() {
		return '/' . \basename(self::getHistoryRootFolderPath());
	}

	protected static function getHistoryRootFolderPath() {
		return realpath(__DIR__ . '/../historyFiles/');
	}

	public static function getUserResourceFileFolder() {
		return 'resource';
	}

	public static function getUserResultFileFolder() {
		return 'result';
	}

	public static function getUserResourceFileFolderPath() {
		return realpath(self::getHistoryRootFolderPath() . self::getUserResourceFileFolder());
	}

	public static function getUserResultFileFolderPath() {
		return realpath(self::getHistoryRootFolderPath() . self::getUserResultFileFolder());
	}

	public static function createFileUrl($historyType, $unixstamp, $tempName, $fileInfo) {
		return sprintf(
			'%s/%s/%s_%s_%s_%s',
			self::getUrlHistoryRootFolderPath(),
			$historyType,
			$unixstamp,
			$tempName,
			$fileInfo['size'],
			$fileInfo['name']
		);
	}
}