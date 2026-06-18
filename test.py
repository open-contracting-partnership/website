import pandas as pd
EXCEL_2025 = 'https://data.open-contracting.org/en/publication/41/download?name=2025.xlsx'
EXCEL_2026 = 'https://data.open-contracting.org/en/publication/41/download?name=2026.xlsx'
def load_and_concat(sheet_name, xl25, xl26):
  """Load a sheet from both yearly files and concatenate."""
  frames = []
  if sheet_name in xl25.sheet_names:
    frames.append(xl25.parse(sheet_name))
  if sheet_name in xl26.sheet_names:
    frames.append(xl26.parse(sheet_name))
  if not frames:
    return pd.DataFrame()
  return pd.concat(frames, ignore_index=True)
xl25 = pd.ExcelFile(EXCEL_2025)
xl26 = pd.ExcelFile(EXCEL_2026)
main = load_and_concat('main', xl25, xl26)
main['date'] = pd.to_datetime(main['date'], utc=True)
# Child sheets
awards = load_and_concat('awards', xl25, xl26)
contracts = load_and_concat('contracts', xl25, xl26)
parties = load_and_concat('parties', xl25, xl26)
# ... repeat for all sheets you need
