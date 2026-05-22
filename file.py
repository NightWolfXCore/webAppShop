import os
from pathlib import Path


EXCLUDED_DIRS = {
    Path(".git").resolve(),
    Path("__pycache__").resolve(),
    Path("node_modules").resolve(),
    Path("venv").resolve(),
    Path(".idea").resolve(),
    Path(".vscode").resolve(),
    Path("importantForPlanning").resolve(),

    # Полный путь
    Path(r"C:\OpenServer\domains\confectioneryShop\assets\img").resolve()
}


def export_all_code(source_folder, output_file):
    source_folder = Path(source_folder)
    output_file = Path(output_file)

    total_files = 0

    with open(output_file, "w", encoding="utf-8") as out_file:

        for root, dirs, files in os.walk(source_folder):

            # Проверяем полный путь
            dirs[:] = [
                d for d in dirs
                if (Path(root) / d).resolve() not in EXCLUDED_DIRS
            ]

            for file_name in files:
                file_path = Path(root) / file_name

                try:
                    with open(file_path, "r", encoding="utf-8", errors="ignore") as f:
                        content = f.read()

                    out_file.write("=" * 120 + "\n")
                    out_file.write(f"FILE NAME: {file_name}\n")
                    out_file.write(f"FULL PATH: {file_path.resolve()}\n")
                    out_file.write("-" * 120 + "\n")
                    out_file.write(content)
                    out_file.write("\n\n\n")

                    total_files += 1
                    print(f"[OK] {file_path}")

                except Exception as e:
                    print(f"[ERROR] {file_path} -> {e}")

    print("\n======================================")
    print(f"ГОТОВО. Обработано файлов: {total_files}")
    print(f"Результат сохранен в: {output_file.resolve()}")
    print("======================================")


if __name__ == "__main__":
    source_directory = input("Введите путь к папке: ").strip()
    output_txt = input("Введите имя txt файла: ").strip()

    export_all_code(source_directory, output_txt)