# -*-coding utf-8-*-
# Windows.py

import sys
from PyQt5.QtWidgets import *
from PyQt5.QtCore import *
import pymysql

# kospi_top5 = {
#     'code': ['005930', '015760', '005380', '090430', '012330'],
#     'name': ['삼성전자', '한국전력', '현대차', '아모레퍼시픽', '현대모비스'],
#     'cprice': ['1,269,000', '60,100', '132,000', '414,500', '243,500']
# }
# column_idx_lookup = {'code': 0, 'name': 1, 'cprice': 2}

class MyWindow(QMainWindow):
    def __init__(self):
        super().__init__()
        self.setupUI()

    def setupUI(self):
        self.setGeometry(800, 200, 800, 500)

        self.tableWidget = QTableWidget(self)
        self.tableWidget.resize(780, 480)
        self.tableWidget.setRowCount(3)
        self.tableWidget.setColumnCount(5)

        self.setTableWidgetData()

    def setTableWidgetData(self):
        column_headers = ['아이디', '이름', '기수', '레이팅', '티어']
        self.tableWidget.setHorizontalHeaderLabels(column_headers)  # 제목 설정

        # self.tableWidget.setItem(0, 0, QTableWidgetItem("(0,0"))
        # self.tableWidget.setItem(0, 1, QTableWidgetItem("(0,1"))
        # self.tableWidget.setItem(1, 0, QTableWidgetItem("(1,0"))
        # self.tableWidget.setItem(1, 1, QTableWidgetItem("(1,1"))

        SQLresult = MySql()
        for i in SQLresult:


def MySql():
    conn = pymysql.connect(host='localhost', user='root', password='root1234', db='contest', charset='utf8')

    curs = conn.cursor()

    sql = "SELECT id,name,year,rating,tier FROM `member`"    # SQL Query
    curs.execute(sql)

    rows = curs.fetchall()  # rows : Tuple ex) (1, '김수정', 1, '서울')
    print(rows)

    conn.close()



def main():
    app = QApplication(sys.argv)
    mywindow = MyWindow()
    mywindow.show()
    app.exec_()

if __name__ == "__main__":
    main()