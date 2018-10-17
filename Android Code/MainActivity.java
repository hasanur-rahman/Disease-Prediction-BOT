package com.example.user_pc.firstaid;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.ListView;
import android.widget.Toast;

public class MainActivity extends AppCompatActivity {

    public static int position = 0;

    // Array of strings...
    ListView simpleList;
    String countryList[] = {"BLEEDING", "CLEANING & BANDAGING WOUNDS", "EYE INJURIES", "BURNS", "CHEMICAL BURNS", "SUNBURN", "UNCONSCIOUSNESS", "CHOKING", "INFANT CHOKING", "POISON", "ANIMAL BITES", "BEE STING"};

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);


        simpleList = (ListView)findViewById(R.id.simpleListView);
        ArrayAdapter<String> arrayAdapter = new ArrayAdapter<String>(this, R.layout.activity_list_view, R.id.textView, countryList);
        simpleList.setAdapter(arrayAdapter);

        simpleList.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int pos, long id) {
                position = pos;
                Toast.makeText(MainActivity.this, "" + position, Toast.LENGTH_SHORT).show();
                Intent intent = new Intent(MainActivity.this, FirstAidDetails.class);
                startActivity(intent);
            }
        });
    }
}
